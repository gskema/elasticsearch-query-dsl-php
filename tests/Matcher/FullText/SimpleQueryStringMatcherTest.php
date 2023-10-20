<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class SimpleQueryStringMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "simple_query_string": {
                    "query": "this AND that OR thus",
                    "analyze_wildcard": true
                }
             }',
            new SimpleQueryStringMatcher('this AND that OR thus', ['analyze_wildcard' => true]),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new SimpleQueryStringMatcher('this AND that OR thus', ['analyze_wildcard' => true]);
        self::assertInstanceOf(SimpleQueryStringMatcher::class, $matcher1);
    }
}
