<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class TermMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "term": {
                    "field1": "value1"
                }
            }',
            new TermMatcher('field1', 'value1'),
        ];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "term": {
                    "field1": {
                        "value": "value1",
                        "boost": 1.0
                    }
                }
            }',
            new TermMatcher('field1', 'value1', ['boost' => 1.0]),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new TermMatcher('field1', 'value1');
        self::assertInstanceOf(TermMatcher::class, $matcher1);
    }
}
