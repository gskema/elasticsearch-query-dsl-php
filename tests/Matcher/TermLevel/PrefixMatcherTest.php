<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class PrefixMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "prefix": {
                    "field1": "prefix1"
                }
            }',
            new PrefixMatcher('field1', 'prefix1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "prefix": {
                    "field1": {
                        "value": "prefix1",
                        "boost": 1.0
                    }
                }
            }',
            new PrefixMatcher('field1', 'prefix1', ['boost' => 1.0]),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new PrefixMatcher('field1', 'prefix1');
        self::assertInstanceOf(PrefixMatcher::class, $matcher1);
    }
}
