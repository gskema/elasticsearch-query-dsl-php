<?php

namespace Gskema\ElasticSearchQueryDSL\Model\Script;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class FileScriptTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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

    public function testMethods()
    {
        $script = new FileScript('file1', [
            'param1' => 'value1',
        ], 'painless');

        $this->assertInstanceOf(FileScript::class, $script);
    }
}
