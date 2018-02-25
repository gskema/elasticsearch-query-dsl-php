<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-pipeline-extended-stats-bucket-aggregation.html
 * @see ExtendedStatsBucketAggregationTest
 *
 * @options 'gap_policy' => 'skip', 'insert_zeros'
 *          'format' => ?,
 *          'sigma' => 3,
 */
class ExtendedStatsBucketAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'extended_stats_bucket';
    }
}
