<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-pipeline-sum-bucket-aggregation.html
 * @see SumBucketAggregationTest
 *
 * @options 'gap_policy' => 'skip', 'insert_zeros',
 *          'format' => ?,
 */
class SumBucketAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'sum_bucket';
    }
}
