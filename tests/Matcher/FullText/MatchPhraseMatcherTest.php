<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class MatchPhraseMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "match_phrase": {
                    "field1": {
                        "query": "query1"
                    }
                }
             }',
            new MatchPhraseMatcher('field1', 'query1'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new MatchPhraseMatcher('field1', 'query1');
        self::assertInstanceOf(MatchPhraseMatcher::class, $matcher1);
    }
}
