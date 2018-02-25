<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\AbstractNumericPipelineAggregation;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-pipeline-cumulative-sum-aggregation.html
 * @see CumulativeSumBucketAggregationTest
 *
 * @options 'format' => ?,
 */
class CumulativeSumBucketAggregation extends AbstractNumericPipelineAggregation
{
    /**
     * @inheritdoc
     */
    protected function getType(): string
    {
        return 'cumulative_sum';
    }
}
