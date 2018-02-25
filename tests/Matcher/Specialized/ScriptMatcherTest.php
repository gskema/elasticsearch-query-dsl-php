<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class ScriptMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "script": {
                    "script": {
                        "source": "doc[\'num1\'].value > 1",
                        "lang": "painless"
                    }
                }
            }',
            new ScriptMatcher(
                new InlineScript(
                    'doc[\'num1\'].value > 1',
                    [],
                    'painless'
                )
            ),
        ];

        return $dataSets;
    }
}
