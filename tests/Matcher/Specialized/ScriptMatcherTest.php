<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Model\Script\InlineScript;

final class ScriptMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $matcher1 = new ScriptMatcher(
            new InlineScript(
                'doc[\'num1\'].value > 1',
                [],
                'painless'
            )
        );
        self::assertInstanceOf(ScriptMatcher::class, $matcher1);
    }
}
