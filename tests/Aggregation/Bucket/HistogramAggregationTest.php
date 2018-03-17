<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class HistogramAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "histogram": {
                    "field": "field1",
                    "interval": 5.0
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            HistogramAggregation::fromField('field1', 5.0)
                ->setAgg('key1', new GlobalAggregation()),
        ];


        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "histogram": {
                    "field": "field1",
                    "interval": 5.0,
                    "script": "source1",
                    "missing": 0
                }
            }',
            HistogramAggregation::fromField('field1', 5.0, ['missing' => 0], new InlineScript('source1')),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg1 = HistogramAggregation::fromField('field1', 5.0, [], new InlineScript('source1'));
        $this->assertInstanceOf(HistogramAggregation::class, $agg1);

        $agg2 = HistogramAggregation::fromScript(new InlineScript('source1'), 5.0);
        $this->assertInstanceOf(HistogramAggregation::class, $agg2);
    }
}
