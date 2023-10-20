<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-boosting-query.html
 * @see BoostingMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class BoostingMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected MatcherInterface $positiveQuery,
        protected MatcherInterface $negativeQuery,
        protected float $negativeBoost,
    ) {
    }

    public function __clone()
    {
        $this->positiveQuery = clone $this->positiveQuery;
        $this->negativeQuery = clone $this->negativeQuery;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [
            'positive' => $this->positiveQuery->jsonSerialize(),
            'negative' => $this->negativeQuery->jsonSerialize(),
            'negative_boost' => $this->negativeBoost,
        ];
        $body += $this->options;

        return [
            'boosting' => $body,
        ];
    }
}
