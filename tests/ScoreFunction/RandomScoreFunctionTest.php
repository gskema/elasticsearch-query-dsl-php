<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class RandomScoreFunctionTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "random_score": {}
            }',
            (new RandomScoreFunction()),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "random_score": {
                    "seed": 1,
                    "field": "field1"
                }
            }',
            (new RandomScoreFunction(1, 'field1')),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $function = (new RandomScoreFunction(1));

        self::assertInstanceOf(RandomScoreFunction::class, $function);
    }
}
