<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\HasAggsTrait;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-nested-aggregation.html
 * @see NestedAggregationTest
 */
class NestedAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    public function __construct(
        protected string $path,
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
        $body['nested']['path'] = $this->path;

        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
