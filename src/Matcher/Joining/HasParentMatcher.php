<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Joining;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-has-parent-query.html
 * @see HasParentMatcherTest
 */
#[Options([
    'score' => true,
    'ignore_unmapped' => true,
    '_name' => '?',
])]
class HasParentMatcher implements MatcherInterface
{
    use HasOptionsTrait;
    use HasInnerHitsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $parentType,
        protected MatcherInterface $query,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->query = clone $this->query;
        $this->innerHits = $this->innerHits ? clone $this->innerHits : null;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['parent_type'] = $this->parentType;
        $body += $this->options;
        $body['query'] = $this->query;

        if ($this->hasInnerHits()) {
            $body['inner_hits'] = $this->innerHits->jsonSerialize();
        }

        return [
            'has_parent' => $body,
        ];
    }
}
