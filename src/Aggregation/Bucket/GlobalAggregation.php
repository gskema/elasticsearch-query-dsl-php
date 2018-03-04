<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-global-aggregation.html
 * @see GlobalAggregationTest
 */
class GlobalAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

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
