<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Compound;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Matcher\TermLevel\TermMatcher;
use Gskema\ElasticsearchQueryDSL\Matcher\TermLevel\TermsMatcher;
use InvalidArgumentException;

final class DisMaxScoreMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "dis_max": {
                    "queries": [
                        { "term": { "field1": "value1"} },
                        { "terms": { "field2": ["value2", "value3"] } }
                    ],
                    "boost": 1.0,
                    "tie_breaker": 5
                }
             }',
            new DisMaxScoreMatcher(
                [
                    new TermMatcher('field1', 'value1'),
                    new TermsMatcher('field2', ['value2', 'value3'])
                ],
                [
                    'boost' => 1.0,
                    'tie_breaker' => 5
                ]
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new DisMaxScoreMatcher(
            [
                new TermMatcher('field1', 'value1'),
                new TermsMatcher('field2', ['value2', 'value3'])
            ],
            [
                'boost' => 1.0,
                'tie_breaker' => 5
            ]
        );
        self::assertInstanceOf(DisMaxScoreMatcher::class, $matcher1);

        $this->expectException(InvalidArgumentException::class);
        new DisMaxScoreMatcher([]);
    }
}
