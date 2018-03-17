<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class DateHistogramAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "date_histogram": {
                    "field": "field1",
                    "interval": "1day"
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            DateHistogramAggregation::fromField(
                'field1',
                '1day'
            )->setAgg('key1', new GlobalAggregation()),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "date_histogram": {
                    "field": "field1",
                    "interval": "1day",
                    "script": "source1",
                    "missing": 0
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            DateHistogramAggregation::fromField(
                'field1',
                '1day',
                ['missing' => 0],
                new InlineScript('source1')
            )->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg1 = DateHistogramAggregation::fromField('field1', '1day', [], new InlineScript('source1'));
        $this->assertInstanceOf(DateHistogramAggregation::class, $agg1);

        $agg2 = DateHistogramAggregation::fromScript(new InlineScript('source1'), '1day');
        $this->assertInstanceOf(DateHistogramAggregation::class, $agg2);
    }
}
