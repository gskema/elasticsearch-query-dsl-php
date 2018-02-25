<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-geocentroid-aggregation.html
 * @see GeoCentroidAggregationTest
 */
class GeoCentroidAggregation implements MetricAggregationInterface
{
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
        return [
            'geo_centroid' => [
                'field' => $this->field,
            ],
        ];
    }
}
