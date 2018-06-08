<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-global-aggregation.html
 * @see GlobalAggregationTest
 */
class GlobalAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    public function __clone()
    {
        $this->aggs = array_clone($this->aggs);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['global'] = new stdClass();

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
