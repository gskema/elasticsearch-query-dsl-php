<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

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

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body['filter'] = $this->filter->jsonSerialize();

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
