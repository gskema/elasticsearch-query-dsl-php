<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-pipeline-derivative-aggregation.html
 * @see DerivativeAggregationTest
 *
 * @options 'gap_policy' => 'skip', 'insert_zeros',
 *          'format' => ?,
 *          'unit' => 'day',
 */
class DerivativeAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'derivative';
    }
}
