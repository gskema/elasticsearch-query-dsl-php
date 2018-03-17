<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class FieldValueFactorScoreFunctionTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
            (new FieldValueFactorScoreFunction('field1')),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "field_value_factor" : {
                    "field" : "field1",
                    "factor": 1
                }
            }',
            (new FieldValueFactorScoreFunction('field1'))->setOption('factor', 1),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $function = (new FieldValueFactorScoreFunction('field1'))->setOption('factor', 1);

        $this->assertInstanceOf(FieldValueFactorScoreFunction::class, $function);
    }
}
