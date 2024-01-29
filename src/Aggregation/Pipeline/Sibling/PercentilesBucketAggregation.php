<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-pipeline-percentiles-bucket-aggregation.html
 * @see PercentilesBucketAggregationTest
 */
#[Options([
    'gap_policy' => 'skip', // 'insert_zeros',
    'format' => '?',
    'percents' => [1, 5, 25, 50, 75, 95, 99],
])]
class PercentilesBucketAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return 'percentiles_bucket';
    }
}
