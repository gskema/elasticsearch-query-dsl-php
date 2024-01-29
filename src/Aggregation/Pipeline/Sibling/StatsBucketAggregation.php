<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-pipeline-stats-bucket-aggregation.html
 * @see StatsBucketAggregationTest
 */
#[Options([
    'gap_policy' => 'skip', // 'insert_zeros',
    'format' => '?',
])]
class StatsBucketAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return 'stats_bucket';
    }
}
