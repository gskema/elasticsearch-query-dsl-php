<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class TypeMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "type": {
                    "value": "docType1"
                }
            }',
            new TypeMatcher('docType1'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new TypeMatcher('docType1');
        self::assertInstanceOf(TypeMatcher::class, $matcher1);
    }
}
