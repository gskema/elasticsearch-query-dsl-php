<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

final class CardinalityAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $agg1 = CardinalityAggregation::fromField('field1', ['precision_threshold' => 3000]);
        self::assertInstanceOf(CardinalityAggregation::class, $agg1);

        $agg2 = CardinalityAggregation::fromScript(new InlineScript('source1'));
        self::assertInstanceOf(CardinalityAggregation::class, $agg2);
    }
}
