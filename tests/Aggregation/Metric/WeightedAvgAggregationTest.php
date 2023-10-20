<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

final class WeightedAvgAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "weighted_avg": {
                    "value": {
                      "field": "value1",
                      "missing": "missing1"
                    },
                    "weight": {
                      "field": "weight1",
                      "missing": "missing2"
                    },
                    "format": "yyyy"
                }
            }',
            new WeightedAvgAggregation(
                'value1',
                'weight1',
                'missing1',
                'missing2',
                ['format' => 'yyyy']
            )
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "weighted_avg": {
                    "value": {
                      "script": "value1",
                      "missing": "missing1"
                    },
                    "weight": {
                      "script": "weight1",
                      "missing": "missing2"
                    },
                    "format": "yyyy"
                }
            }',
            new WeightedAvgAggregation(
                new InlineScript('value1'),
                new InlineScript('weight1'),
                'missing1',
                'missing2',
                ['format' => 'yyyy']
            )
        ];

        return $dataSets;
    }
}
