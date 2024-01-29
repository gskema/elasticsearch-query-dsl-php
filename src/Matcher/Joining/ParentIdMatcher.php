<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Joining;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-parent-id-query.html
 * @see ParentIdMatcherTest
 */
#[Options([
    'ignore_unmapped' => true,
    '_name' => '?',
])]
class ParentIdMatcher implements MatcherInterface
{
    use HasOptionsTrait;
    use HasInnerHitsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $childType,
        protected string $parentId,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->innerHits = $this->innerHits ? clone $this->innerHits : null;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [
            'type' => $this->childType,
            'id' => $this->parentId,
        ];
        $body += $this->options;

        if ($this->hasInnerHits()) {
            $body['inner_hits'] = $this->innerHits->jsonSerialize();
        }

        return [
            'parent_id' => $body,
        ];
    }
}
