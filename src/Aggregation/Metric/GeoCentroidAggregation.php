<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-geocentroid-aggregation.html
 * @see GeoCentroidAggregationTest
 */
class GeoCentroidAggregation implements MetricAggregationInterface
{
    public function __construct(
        protected string $field,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'geo_centroid' => [
                'field' => $this->field,
            ],
        ];
    }
}
