<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-pipeline-cumulative-sum-aggregation.html
 * @see CumulativeSumBucketAggregationTest
 */
#[Options([
    'format' => '?',
])]
class CumulativeSumBucketAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return 'cumulative_sum';
    }
}
