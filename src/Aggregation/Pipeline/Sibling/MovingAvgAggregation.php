<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-pipeline-movavg-aggregation.html
 * @see MovingAvgAggregationTest
 *
 * @options 'model' => 'simple', 'linear', 'ewma', 'holt', 'holt_winters',
 *          'gap_policy' => 'skip', 'insert_zeros',
 *          'window' => 5,
 *          'minimize' => false,
 *          'settings' => ['alpha' => 0.5, 'beta' => 0.1, 'gamma' => 0.3, 'period' => 7, 'type' => 'add', 'pad' => false],
 *          'predict' => 10,
 *          'minimize' => true,
 */
class MovingAvgAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'moving_avg';
    }
}
