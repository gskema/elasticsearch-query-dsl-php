<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-extendedstats-aggregation.html
 * @see ExtendedStatsAggregationTest
 *
 * @options 'sigma' => 3,
 *          'missing' => 0,
 */
class ExtendedStatsAggregation extends AbstractNumericMetricAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'extended_stats';
    }
}
