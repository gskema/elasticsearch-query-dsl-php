<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Span;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class SpanTermMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "span_term" : {
                    "field1": "value1"
                }
            }',
            new SpanTermMatcher('field1', 'value1'),
        ];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "span_term" : {
                    "field1": {
                      "value": "value1",
                      "_name": "name1"
                    }
                }
            }',
            new SpanTermMatcher('field1', 'value1', [
                '_name' => 'name1'
            ]),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new SpanTermMatcher('field1', 'value1');
        self::assertInstanceOf(SpanTermMatcher::class, $matcher1);
    }
}
