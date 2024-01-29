<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-pipeline-extended-stats-bucket-aggregation.html
 * @see ExtendedStatsBucketAggregationTest
 */
#[Options([
    'gap_policy' => 'skip', // 'insert_zeros'
    'format' => '?',
    'sigma' => 3,
])]
class ExtendedStatsBucketAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return 'extended_stats_bucket';
    }
}
