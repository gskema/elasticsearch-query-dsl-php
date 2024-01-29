<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\HasAggsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

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
