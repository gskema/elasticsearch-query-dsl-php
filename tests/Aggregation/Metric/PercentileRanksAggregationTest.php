<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class PercentileRanksAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "percentile_ranks": {
                    "field": "field1",
                    "values": [1, 2, 3]
                }
            }',
            PercentileRanksAggregation::fromField(
                'field1',
                [1, 2, 3]
            ),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "percentile_ranks": {
                    "field": "field1",
                    "values": [1, 2, 3],
                    "keyed": true,
                    "script": "source1"
                }
            }',
            PercentileRanksAggregation::fromField(
                'field1',
                [1, 2, 3],
                ['keyed' => true],
                new InlineScript('source1')
            ),
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            '{
                "percentile_ranks": {
                    "values": [1, 2, 3],
                    "keyed": true,
                    "script": "source1"
                }
            }',
            PercentileRanksAggregation::fromScript(
                [1, 2, 3],
                new InlineScript('source1'),
                ['keyed' => true]
            ),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg1 = PercentileRanksAggregation::fromField(
            'field1',
            ['value1', 'value2'],
            ['keyed' => true],
            new InlineScript('source1')
        );
        $this->assertInstanceOf(PercentileRanksAggregation::class, $agg1);

        $agg2 = PercentileRanksAggregation::fromScript(
            ['value1', 'value2'],
            new InlineScript('source1'),
            ['keyed' => true]
        );
        $this->assertInstanceOf(PercentileRanksAggregation::class, $agg2);
    }
}
