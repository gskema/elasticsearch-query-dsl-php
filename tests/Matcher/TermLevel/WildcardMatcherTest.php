<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class WildcardMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "wildcard": {
                    "field1": "value1*"
                }
            }',
            new WildcardMatcher('field1', 'value1*'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "wildcard": {
                    "field1": {
                        "value": "value1*",
                        "boost": 2.0
                    }
                }
            }',
            new WildcardMatcher('field1', 'value1*', ['boost' => 2.0]),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new WildcardMatcher('field1', 'value1*');
        self::assertInstanceOf(WildcardMatcher::class, $matcher1);
    }
}
