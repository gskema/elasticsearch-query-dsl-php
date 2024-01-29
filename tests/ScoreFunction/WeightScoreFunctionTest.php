<?php

namespace Gskema\ElasticsearchQueryDSL\ScoreFunction;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class WeightScoreFunctionTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $function = (new WeightScoreFunction(5));

        self::assertInstanceOf(WeightScoreFunction::class, $function);
    }
}
