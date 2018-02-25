<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-pipeline-percentiles-bucket-aggregation.html
 * @see PercentilesBucketAggregationTest
 *
 * @options 'gap_policy' => 'skip', 'insert_zeros',
 *          'format' => ?,
 *          'percents' => [1, 5, 25, 50, 75, 95, 99],
 */
class PercentilesBucketAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'percentiles_bucket';
    }
}
