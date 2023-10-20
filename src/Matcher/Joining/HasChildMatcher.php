<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-has-child-query.html
 * @see HasChildMatcherTest
 */
#[Options([
    'score_mode' => 'min', // 'max', 'sum', 'avg', 'none',
    'min_children' => 2,
    'max_children' => 10,
    'ignore_unmapped' => true,
    '_name' => '?',
])]
class HasChildMatcher implements MatcherInterface
{
    use HasOptionsTrait;
    use HasInnerHitsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $childType,
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
        $body['type'] = $this->childType;
        $body['query'] = $this->query->jsonSerialize();
        $body += $this->options;

        if ($this->hasInnerHits()) {
            $body['inner_hits'] = $this->innerHits->jsonSerialize();
        }

        return [
            'has_child' => $body,
        ];
    }
}
