<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

final class AutoIntervalDateHistogramAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "auto_date_histogram": {
                    "field": "field1",
                    "buckets": 10,
                    "format": "yyyy-MM-dd"
                },
                "aggs": {
                  "agg1": {
                    "global": {}
                  }
                }
            }',
            (AutoIntervalDateHistogramAggregation::fromField('field1', 10, ['format' => 'yyyy-MM-dd']))
                ->setAgg('agg1', new GlobalAggregation())
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "auto_date_histogram": {
                    "field": "field1",
                    "script": "script1",
                    "buckets": 10,
                    "format": "yyyy-MM-dd"
                },
                "aggs": {
                  "agg1": {
                    "global": {}
                  }
                }
            }',
            AutoIntervalDateHistogramAggregation::fromField(
                'field1',
                10,
                ['format' => 'yyyy-MM-dd'],
                new InlineScript('script1'),
            )->setAgg('agg1', new GlobalAggregation())
        ];


        // #2
        $dataSets[] = [
            // language=JSON
            '{
                "auto_date_histogram": {

                    "script": "script1",
                    "buckets": 10,
                    "format": "yyyy-MM-dd"
                },
                "aggs": {
                  "agg1": {
                    "global": {}
                  }
                }
            }',
            AutoIntervalDateHistogramAggregation::fromScript(
                new InlineScript('script1'),
                10,
                ['format' => 'yyyy-MM-dd'],
            )->setAgg('agg1', new GlobalAggregation())
        ];

        return $dataSets;
    }
}
