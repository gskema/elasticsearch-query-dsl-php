<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\FullText;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class QueryStringMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "query_string": {
                    "query": "this AND that OR thus",
                    "default_field": "body"
                }
             }',
            new QueryStringMatcher('this AND that OR thus', ['default_field' => 'body']),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new QueryStringMatcher('this AND that OR thus', ['default_field' => 'body']);
        self::assertInstanceOf(QueryStringMatcher::class, $matcher1);
    }
}
