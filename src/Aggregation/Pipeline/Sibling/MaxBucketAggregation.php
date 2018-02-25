<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-pipeline-max-bucket-aggregation.html
 * @see MaxBucketAggregationTest
 *
 * @options 'gap_policy' => 'skip', 'insert_zeros',
 *          'format' => ?,
 */
class MaxBucketAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'max_bucket';
    }
}
