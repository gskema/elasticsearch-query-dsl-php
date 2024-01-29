<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-avg-aggregation.html
 * @see AvgAggregationTest
 */
#[Options([
    'missing' => 0,
])]
class AvgAggregation extends AbstractNumericMetricAggregation
{
    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return 'avg';
    }
}
