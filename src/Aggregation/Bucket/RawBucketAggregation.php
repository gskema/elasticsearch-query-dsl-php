<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\RawFragment;

/**
 * @see RawBucketAggregationTest
 */
class RawBucketAggregation extends RawFragment implements BucketAggregationInterface
{
    use HasAggsTrait;

    public function __clone()
    {
        parent::__clone();
        $this->aggs = array_clone($this->aggs);
    }

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
