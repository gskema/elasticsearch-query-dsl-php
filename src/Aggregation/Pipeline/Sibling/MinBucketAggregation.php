<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-pipeline-min-bucket-aggregation.html
 * @see MinBucketAggregationTest
 *
 * @options 'gap_policy' => 'skip', 'insert_zeros',
 *          'format' => ?,
 */
class MinBucketAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'min_bucket';
    }
}
