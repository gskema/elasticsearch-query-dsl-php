<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class MatchMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "match": {
                    "field1": {
                        "query": "query1"
                    }
                }
             }',
            new MatchMatcher('field1', 'query1'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new MatchMatcher('field1', 'query1');
        self::assertInstanceOf(MatchMatcher::class, $matcher1);
    }
}
