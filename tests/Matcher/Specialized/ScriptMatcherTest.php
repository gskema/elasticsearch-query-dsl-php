<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

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
