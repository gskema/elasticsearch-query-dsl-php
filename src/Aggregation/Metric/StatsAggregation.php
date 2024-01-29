<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-stats-aggregation.html
 * @see StatsAggregationTest
 */
#[Options([
    'missing' => 0,
])]
class StatsAggregation extends AbstractNumericMetricAggregation
{
    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return 'stats';
    }
}
