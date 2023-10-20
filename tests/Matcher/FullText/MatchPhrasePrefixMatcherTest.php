<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class MatchPhrasePrefixMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "match_phrase_prefix": {
                    "field1": {
                        "query": "query1",
                        "max_expansions": 10
                    }
                }
             }',
            new MatchPhrasePrefixMatcher('field1', 'query1', ['max_expansions' => 10]),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new MatchPhrasePrefixMatcher('field1', 'query1', ['max_expansions' => 10]);
        self::assertInstanceOf(MatchPhrasePrefixMatcher::class, $matcher1);
    }
}
