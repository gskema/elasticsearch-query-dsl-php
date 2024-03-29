<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class ExistsMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "exists": {
                    "field": "field1"
                }
            }',
            new ExistsMatcher('field1'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new ExistsMatcher('field1');
        self::assertInstanceOf(ExistsMatcher::class, $matcher1);
    }
}
