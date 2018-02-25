<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class RandomScoreFunctionTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
                    "seed": 1
                }
            }',
            (new RandomScoreFunction(1)),
        ];

        return $dataSets;
    }
}
