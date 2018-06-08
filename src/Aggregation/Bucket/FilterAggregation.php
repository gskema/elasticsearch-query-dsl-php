<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-filter-aggregation.html
 * @see FilterAggregationTest
 */
class FilterAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    /** @var MatcherInterface */
    protected $filter;

    public function __construct(MatcherInterface $filter)
    {
        $this->filter = $filter;
    }

    public function __clone()
    {
        $this->filter = clone $this->filter;
        $this->aggs = array_clone($this->aggs);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['filter'] = $this->filter->jsonSerialize();

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
