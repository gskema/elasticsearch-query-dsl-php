<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class IdsMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "ids": {
                    "values": ["id1", "id2"]
                }
            }',
            new IdsMatcher(['id1', 'id2']),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "ids": {
                    "values": ["id1", "id2"],
                    "type": "type1"
                }
            }',
            new IdsMatcher(['id1', 'id2'], 'type1'),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new IdsMatcher(['id1', 'id2'], 'type1');
        $this->assertInstanceOf(IdsMatcher::class, $matcher1);
    }
}
