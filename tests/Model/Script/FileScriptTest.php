<?php

namespace Gskema\ElasticsearchQueryDSL\Model\Script;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class FileScriptTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "file": "file1"
            }',
            new FileScript('file1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "file": "file1",
                "params": {
                    "param1": "value1"
                }
             }',
            new FileScript('file1', [
                'param1' => 'value1',
            ]),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "file": "file1",
                "params": {
                    "param1": "value1"
                },
                "lang": "painless"
             }',
            new FileScript('file1', [
                'param1' => 'value1',
            ], 'painless'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $script = new FileScript('file1', [
            'param1' => 'value1',
        ], 'painless');

        self::assertInstanceOf(FileScript::class, $script);
    }
}
