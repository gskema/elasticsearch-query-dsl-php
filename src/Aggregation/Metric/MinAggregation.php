<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-min-aggregation.html
 * @see MinAggregationTest
 */
#[Options([
    'missing' => 0,
])]
class MinAggregation extends AbstractNumericMetricAggregation
{
    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return 'min';
    }
}
