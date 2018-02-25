<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

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

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body['missing']['field'] = $this->field;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
