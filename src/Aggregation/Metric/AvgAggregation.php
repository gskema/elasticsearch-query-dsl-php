<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-avg-aggregation.html
 * @see AvgAggregationTest
 *
 * @options 'missing' => 0,
 */
class AvgAggregation extends AbstractNumericMetricAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'avg';
    }
}
