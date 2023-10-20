<?php

namespace Gskema\ElasticSearchQueryDSL\Model\Script;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class IndexedScriptTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $script = new IndexedScript('id1', [
            'param1' => 'value1',
        ]);

        self::assertInstanceOf(IndexedScript::class, $script);
    }
}
