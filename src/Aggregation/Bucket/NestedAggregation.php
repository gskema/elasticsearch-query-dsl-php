<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasAggsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-nested-aggregation.html
 * @see NestedAggregationTest
 */
class NestedAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    /** @var string */
    protected $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

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
        $body['nested']['path'] = $this->path;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
