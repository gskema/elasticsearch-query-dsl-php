<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-stats-aggregation.html
 * @see StatsAggregationTest
 *
 * @options 'missing' => 0,
 */
class StatsAggregation extends AbstractNumericMetricAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'stats';
    }
}
