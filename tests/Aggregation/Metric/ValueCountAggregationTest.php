<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

final class ValueCountAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $agg1 = ValueCountAggregation::fromField('field1');
        self::assertInstanceOf(ValueCountAggregation::class, $agg1);

        $agg2 = ValueCountAggregation::fromScript(new InlineScript('source1'));
        self::assertInstanceOf(ValueCountAggregation::class, $agg2);
    }
}
