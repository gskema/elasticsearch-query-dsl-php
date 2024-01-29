<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-sum-aggregation.html
 * @see SumAggregationTest
 */
#[Options([
    'missing' => 0,
])]
class SumAggregation extends AbstractNumericMetricAggregation
{
    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return 'sum';
    }
}
