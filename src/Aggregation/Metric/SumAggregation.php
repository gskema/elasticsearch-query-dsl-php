<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-sum-aggregation.html
 * @see SumAggregationTest
 *
 * @options 'missing' => 0,
 */
class SumAggregation extends AbstractNumericMetricAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'sum';
    }
}
