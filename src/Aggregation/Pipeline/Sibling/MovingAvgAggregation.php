<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-pipeline-movavg-aggregation.html
 * @see MovingAvgAggregationTest
 */
#[Options([
    'model' => 'simple', // 'linear', 'ewma', 'holt', 'holt_winters',
    'gap_policy' => 'skip', // 'insert_zeros',
    'window' => 5,
    'minimize' => false,
    'settings' => ['alpha' => 0.5, 'beta' => 0.1, 'gamma' => 0.3, 'period' => 7, 'type' => 'add', 'pad' => false],
    'predict' => 10,
])]
class MovingAvgAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return 'moving_avg';
    }
}
