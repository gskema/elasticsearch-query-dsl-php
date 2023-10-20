<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class LookupTermsMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "terms": {
                    "field1": {
                        "index": "index1",
                        "type": "type1",
                        "id": "id1",
                        "path": "path1"
                    }
                }
            }',
            new LookupTermsMatcher(
                'field1',
                'index1',
                'type1',
                'id1',
                'path1'
            ),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "terms": {
                    "field1": {
                        "index": "index1",
                        "type": "type1",
                        "id": "id1",
                        "path": "path1",
                        "routing": "routing1"
                    }
                }
            }',
            new LookupTermsMatcher(
                'field1',
                'index1',
                'type1',
                'id1',
                'path1',
                'routing1'
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new LookupTermsMatcher(
            'field1',
            'index1',
            'type1',
            'id1',
            'path1'
        );
        self::assertInstanceOf(LookupTermsMatcher::class, $matcher1);
    }
}
