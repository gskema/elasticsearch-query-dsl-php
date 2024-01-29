<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\HasAggsTrait;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-children-aggregation.html
 * @see ChildrenAggregationTest
 */
class ChildrenAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    public function __construct(
        protected string $childrenType,
    ) {
    }

    public function __clone()
    {
        $this->aggs = array_clone($this->aggs);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['children']['type'] = $this->childrenType;

        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
