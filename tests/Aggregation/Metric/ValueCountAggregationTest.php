<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class ValueCountAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "value_count": {
                    "field": "field1"
                }
            }',
            ValueCountAggregation::fromField('field1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "value_count": {
                    "script": "source1"
                }
            }',
            ValueCountAggregation::fromScript(new InlineScript('source1')),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg1 = ValueCountAggregation::fromField('field1');
        $this->assertInstanceOf(ValueCountAggregation::class, $agg1);

        $agg2 = ValueCountAggregation::fromScript(new InlineScript('source1'));
        $this->assertInstanceOf(ValueCountAggregation::class, $agg2);
    }
}
