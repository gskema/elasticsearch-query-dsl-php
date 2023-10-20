<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use function Gskema\ElasticSearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-filter-aggregation.html
 * @see FilterAggregationTest
 */
class FilterAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    public function __construct(
        protected MatcherInterface $filter,
    ) {
    }

    public function __clone()
    {
        $this->filter = clone $this->filter;
        $this->aggs = array_clone($this->aggs);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['filter'] = $this->filter->jsonSerialize();

        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
