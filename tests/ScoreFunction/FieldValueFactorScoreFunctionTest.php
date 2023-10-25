<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class FieldValueFactorScoreFunctionTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "field_value_factor": {
                    "field" : "field1"
                }
            }',
            new FieldValueFactorScoreFunction('field1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "field_value_factor" : {
                    "field" : "field1",
                    "factor": 1,
                    "modifier": "ln",
                    "missing": 0
                }
            }',
            new FieldValueFactorScoreFunction('field1', 1, 'ln', 0)
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $function = new FieldValueFactorScoreFunction('field1', 1);

        self::assertInstanceOf(FieldValueFactorScoreFunction::class, $function);
    }
}
