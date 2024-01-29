<?php

namespace Gskema\ElasticsearchQueryDSL\ScoreFunction;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class GaussDecayScoreFunctionTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "gauss": {
                   "field": "field1",
                   "origin": "origin1",
                   "scale": "scale1",
                   "offset": "offset1",
                   "decay": "decay1",
                   "multi_value_mode": "mvm1"
                }
            }',
            new GaussDecayScoreFunction(
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
        $function = new GaussDecayScoreFunction(
            'field1',
            'origin1',
            'scale1',
            'offset1',
            'decay1',
            'mvm1'
        );

        self::assertInstanceOf(GaussDecayScoreFunction::class, $function);
    }
}
