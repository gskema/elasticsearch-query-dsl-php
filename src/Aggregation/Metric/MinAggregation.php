<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-min-aggregation.html
 * @see MinAggregationTest
 *
 * @options 'missing' => 0,
 */
class MinAggregation extends AbstractNumericMetricAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'min';
    }
}
