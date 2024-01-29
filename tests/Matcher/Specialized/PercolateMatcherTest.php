<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class PercolateMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "percolate": {
                    "field": "queryField1",
                    "document": {
                        "body": "body1"
                    }
                }

            }',
            PercolateMatcher::fromDocSource(
                'queryField1',
                [
                    'body' => 'body1'
                ]
            ),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "percolate": {
                    "field": "queryField1",
                    "index": "index1",
                    "type": "type1",
                    "id": "id1"
                }

            }',
            PercolateMatcher::fromIndexedDoc(
                'queryField1',
                'index1',
                'type1',
                'id1'
            ),
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            '{
                "percolate": {
                    "field": "queryField1",
                    "documents": [
                        { "body": "body1" },
                        { "body": "body2" }
                    ]
                }

            }',
            PercolateMatcher::fromDocSources(
                'queryField1',
                [
                    ['body' => 'body1'],
                    ['body' => 'body2'],
                ]
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = PercolateMatcher::fromDocSource(
            'queryField1',
            [
                'body' => 'body1'
            ]
        );
        self::assertInstanceOf(PercolateMatcher::class, $matcher1);

        $matcher2 = PercolateMatcher::fromIndexedDoc(
            'queryField1',
            'index1',
            'type1',
            'id1'
        );
        self::assertInstanceOf(PercolateMatcher::class, $matcher2);

        $matcher2 = PercolateMatcher::fromDocSources(
            'queryField1',
            [
                ['body' => 'body1'],
                ['body' => 'body2'],
            ],
        );
        self::assertInstanceOf(PercolateMatcher::class, $matcher2);
    }
}
