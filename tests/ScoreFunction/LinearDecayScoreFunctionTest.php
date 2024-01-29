<?php

namespace Gskema\ElasticsearchQueryDSL\ScoreFunction;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class LinearDecayScoreFunctionTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "linear": {
                   "field": "field1",
                   "origin": "origin1",
                   "scale": "scale1",
                   "offset": "offset1",
                   "decay": "decay1",
                   "multi_value_mode": "mvm1"
                }
            }',
            new LinearDecayScoreFunction(
                'field1',
                'origin1',
                'scale1',
                'offset1',
                'decay1',
                'mvm1'
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $function = new LinearDecayScoreFunction(
            'field1',
            'origin1',
            'scale1',
            'offset1',
            'decay1',
            'mvm1'
        );

        self::assertInstanceOf(LinearDecayScoreFunction::class, $function);
    }
}
