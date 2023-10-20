<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;
use Gskema\ElasticSearchQueryDSL\Options;

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
