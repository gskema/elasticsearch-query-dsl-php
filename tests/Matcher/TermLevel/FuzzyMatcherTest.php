<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class FuzzyMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "fuzzy": {
                    "field1": "value1"
                }
            }',
            new FuzzyMatcher('field1', 'value1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "fuzzy": {
                    "field1": {
                        "value": "value1",
                        "max_expansions": 65
                    }
                }
            }',
            new FuzzyMatcher('field1', 'value1', [
                "max_expansions" => 65
            ]),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new FuzzyMatcher('field1', 'value1');
        self::assertInstanceOf(FuzzyMatcher::class, $matcher1);
    }
}
