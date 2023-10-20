<?php

namespace Gskema\ElasticSearchQueryDSL\Model\Script;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class InlineScriptTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '"source1"',
            new InlineScript('source1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "source": "source1",
                "params": {
                    "param1": "value1"
                }
             }',
            new InlineScript('source1', [
                'param1' => 'value1',
            ]),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "source": "source1",
                "params": {
                    "param1": "value1"
                },
                "lang": "painless"
             }',
            new InlineScript('source1', [
                'param1' => 'value1',
            ], 'painless'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $script = new InlineScript('source1', [
            'param1' => 'value1',
        ], 'painless');

        self::assertInstanceOf(InlineScript::class, $script);
    }
}
