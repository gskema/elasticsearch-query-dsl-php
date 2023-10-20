<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-extendedstats-aggregation.html
 * @see ExtendedStatsAggregationTest
 */
#[Options([
    'sigma' => 3,
    'missing' => 0,
])]
class ExtendedStatsAggregation extends AbstractNumericMetricAggregation
{
    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return 'extended_stats';
    }
}
