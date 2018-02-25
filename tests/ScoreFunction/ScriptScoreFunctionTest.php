<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class ScriptScoreFunctionTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "script_score": {
                    "script": "script1",
                    "boost_mode": "replace"
                }
            }',
            (new ScriptScoreFunction(new InlineScript('script1')))->setOption('boost_mode', 'replace'),
        ];

        return $dataSets;
    }
}
