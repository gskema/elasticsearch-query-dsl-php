<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\RawFragment;

/**
 * @see RawBucketAggregationTest
 */
class RawBucketAggregation extends RawFragment implements BucketAggregationInterface
{
    use HasAggsTrait;

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = parent::jsonSerialize();

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
