<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class PercentilesBucketAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "percentiles_bucket": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new PercentilesBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
