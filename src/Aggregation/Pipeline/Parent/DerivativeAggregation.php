<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-pipeline-derivative-aggregation.html
 * @see DerivativeAggregationTest
 */
#[Options([
    'gap_policy' => 'skip', // 'insert_zeros',
    'format' => '?',
    'unit' => 'day',
])]
class DerivativeAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return 'derivative';
    }
}
