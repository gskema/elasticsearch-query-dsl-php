<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use function Gskema\ElasticSearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-parent-aggregation.html
 * @see ParentAggregationTest
 */
class ParentAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    public function __construct(
        protected string $type,
    ) {
    }

    public function __clone()
    {
        $this->aggs = array_clone($this->aggs);
    }

    public function jsonSerialize(): mixed
    {
        $body = ['parent' => ['type' => $this->type]];
        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
