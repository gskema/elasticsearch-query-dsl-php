<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class CommonTermsMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "common": {
                    "field1": {
                        "query": "query1",
                        "cutoff_frequency": 0.1
                    }
                }
            }',
            new CommonTermsMatcher('field1', 'query1', 0.1),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new CommonTermsMatcher('field1', 'query1', 0.1);
        self::assertInstanceOf(CommonTermsMatcher::class, $matcher1);
    }
}
