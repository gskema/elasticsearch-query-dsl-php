<?php

namespace Gskema\ElasticsearchQueryDSL\ScoreFunction;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Model\Script\InlineScript;

final class ScriptScoreFunctionTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $function = (new ScriptScoreFunction(new InlineScript('script1')))->setOption('boost_mode', 'replace');

        self::assertInstanceOf(ScriptScoreFunction::class, $function);
    }
}
