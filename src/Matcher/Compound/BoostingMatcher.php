<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-boosting-query.html
 * @see BoostingMatcherTest
 *
 * @options '_name' => '?',
 */
class BoostingMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var MatcherInterface */
    protected $positiveQuery;

    /** @var MatcherInterface */
    protected $negativeQuery;

    /** @var float */
    protected $negativeBoost;

    public function __construct(MatcherInterface $positiveQuery, MatcherInterface $negativeQuery, float $negativeBoost)
    {
        $this->positiveQuery = $positiveQuery;
        $this->negativeQuery = $negativeQuery;
        $this->negativeBoost = $negativeBoost;
    }

    public function __clone()
    {
        $this->positiveQuery = clone $this->positiveQuery;
        $this->negativeQuery = clone $this->negativeQuery;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
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
