<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class GaussDecayScoreFunctionTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
            (new GaussDecayScoreFunction('field1', 'origin1', 'scale1'))
                ->setOption('offset', 'offset1')
                ->setOption('decay', 'decay1')
                ->setOption('multi_value_mode', 'mvm1'),
        ];

        return $dataSets;
    }
}
