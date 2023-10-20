<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class MultiMatchMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "multi_match": {
                    "query": "query1",
                    "fields": ["field1", "field2"],
                    "minimum_should_match": 2
                }
             }',
            new MultiMatchMatcher(['field1', 'field2'], 'query1', ['minimum_should_match' => 2]),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new MultiMatchMatcher(['field1', 'field2'], 'query1', ['minimum_should_match' => 2]);
        self::assertInstanceOf(MultiMatchMatcher::class, $matcher1);
    }
}
