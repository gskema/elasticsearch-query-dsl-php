<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;

class RawBucketAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    /** @var array */
    protected $body;

    public function __construct(array $body)
    {
        $this->body = $body;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $this->body;
    }
}
