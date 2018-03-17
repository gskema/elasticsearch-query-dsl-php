<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class AvgAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "avg": {
                    "field": "field1"
                }
            }',
            AvgAggregation::fromField('field1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "avg": {
                    "script": "source1"
                }
            }',
            AvgAggregation::fromScript(new InlineScript('source1')),
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            '{
                "avg": {
                    "field": "field1",
                    "missing": 0,
                    "script": "source1"
                }
            }',
            AvgAggregation::fromField('field1', ['missing' => 0], new InlineScript('source1')),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg1 = AvgAggregation::fromField('field1');
        $this->assertInstanceOf(AvgAggregation::class, $agg1);

        $agg2 = AvgAggregation::fromScript(new InlineScript('source1'));
        $this->assertInstanceOf(AvgAggregation::class, $agg2);
    }
}
