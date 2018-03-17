<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class CardinalityAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "cardinality": {
                    "field": "field1"
                }
            }',
            CardinalityAggregation::fromField('field1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "cardinality": {
                    "script": "source1"
                }
            }',
            CardinalityAggregation::fromScript(new InlineScript('source1'))
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg1 = CardinalityAggregation::fromField('field1', ['precision_threshold' => 3000]);
        $this->assertInstanceOf(CardinalityAggregation::class, $agg1);

        $agg2 = CardinalityAggregation::fromScript(new InlineScript('source1'));
        $this->assertInstanceOf(CardinalityAggregation::class, $agg2);
    }
}
