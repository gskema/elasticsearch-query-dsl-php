<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class MissingMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "bool": {
                    "must_not": {
                        "exists": {
                            "field": "field1"
                        }
                    }
                }
            }',
            new MissingMatcher('field1'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new MissingMatcher('field1');
        self::assertInstanceOf(MissingMatcher::class, $matcher1);
    }
}
