<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class TermsMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "terms": {
                    "field1": ["value1", "value2"]
                }
            }',
            new TermsMatcher('field1', ['value1', 'value2']),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new TermsMatcher('field1', ['value1', 'value2']);
        self::assertInstanceOf(TermsMatcher::class, $matcher1);
    }
}
