<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-geobounds-aggregation.html
 * @see GeoBoundsAggregationTest
 *
 * @options 'wrap_longitude' => true,
 */
class GeoBoundsAggregation implements MetricAggregationInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    public function __construct(string $field, array $options = [])
    {
        $this->field = $field;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body['field'] = $this->field;
        $body += $this->options;

        return [
            'geo_bounds' => $body,
        ];
    }
}
