<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation;

use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-range-aggregation.html#_sub_aggregations
 * @see EmptyAggregationTest
 */
class EmptyAggregation implements AggregationInterface
{
    /** @var string */
    protected $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            $this->type => new stdClass(),
        ];
    }
}
