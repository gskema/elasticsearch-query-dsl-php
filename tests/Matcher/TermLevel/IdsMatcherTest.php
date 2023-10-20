<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class IdsMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $matcher1 = new IdsMatcher(['id1', 'id2'], 'type1');
        self::assertInstanceOf(IdsMatcher::class, $matcher1);
    }
}
