<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class WeightScoreFunctionTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "weight": 5
            }',
            (new WeightScoreFunction(5)),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $function = (new WeightScoreFunction(5));

        $this->assertInstanceOf(WeightScoreFunction::class, $function);
    }
}
