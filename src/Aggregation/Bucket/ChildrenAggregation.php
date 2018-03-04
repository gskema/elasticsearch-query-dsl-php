<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-children-aggregation.html
 * @see ChildrenAggregationTest
 */
class ChildrenAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    /** @var string */
    protected $childrenType;

    public function __construct(string $childrenType)
    {
        $this->childrenType = $childrenType;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['children']['type'] = $this->childrenType;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
