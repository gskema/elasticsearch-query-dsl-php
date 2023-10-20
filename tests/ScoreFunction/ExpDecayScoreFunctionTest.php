<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class ExpDecayScoreFunctionTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "exp": {
                   "field": "field1",
                   "origin": "origin1",
                   "scale": "scale1",
                   "offset": "offset1",
                   "decay": "decay1",
                   "multi_value_mode": "mvm1"
                }
            }',
            new ExpDecayScoreFunction(
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
        $function = new ExpDecayScoreFunction(
            'field1',
            'origin1',
            'scale1',
            'offset1',
            'decay1',
            'mvm1'
        );

        self::assertInstanceOf(ExpDecayScoreFunction::class, $function);
    }
}
