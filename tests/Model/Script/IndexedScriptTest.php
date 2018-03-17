<?php

namespace Gskema\ElasticSearchQueryDSL\Model\Script;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class IndexedScriptTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "id": "id1"
            }',
            new IndexedScript('id1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "id": "id1",
                "params": {
                    "param1": "value1"
                }
             }',
            new IndexedScript('id1', [
                'param1' => 'value1',
            ]),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "id": "id1",
                "params": {
                    "param1": "value1"
                }
             }',
            new IndexedScript('id1', [
                'param1' => 'value1',
            ]),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $script = new IndexedScript('id1', [
            'param1' => 'value1',
        ]);

        $this->assertInstanceOf(IndexedScript::class, $script);
    }
}
