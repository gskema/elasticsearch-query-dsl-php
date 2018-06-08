<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasAggsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-missing-aggregation.html
 * @see MissingAggregationTest
 */
class MissingAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    /** @var string */
    protected $field;

    public function __construct(string $field)
    {
        $this->field = $field;
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
        $body['missing']['field'] = $this->field;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
