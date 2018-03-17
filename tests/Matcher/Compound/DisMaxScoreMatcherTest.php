<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermsMatcher;
use InvalidArgumentException;

class DisMaxScoreMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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

    public function testMethods()
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
        $this->assertInstanceOf(DisMaxScoreMatcher::class, $matcher1);

        $this->expectException(InvalidArgumentException::class);
        new DisMaxScoreMatcher([]);
    }
}
