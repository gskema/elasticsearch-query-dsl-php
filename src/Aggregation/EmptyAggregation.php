<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation;

use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-range-aggregation.html#_sub_aggregations
 * @see EmptyAggregationTest
 */
class EmptyAggregation implements AggregationInterface
{
    public function __construct(
        protected string $type,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            $this->type => new stdClass(),
        ];
    }
}
