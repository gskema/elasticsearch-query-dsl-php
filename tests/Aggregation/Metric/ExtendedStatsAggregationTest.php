<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class ExtendedStatsAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "extended_stats": {
                    "field": "field1"
                }
            }',
            ExtendedStatsAggregation::fromField('field1'),
        ];

        return $dataSets;
    }
}
