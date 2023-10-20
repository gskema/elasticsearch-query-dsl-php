<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class RangeMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "range": {
                    "field1": {
                        "gt": 5,
                        "lte": 10
                    }
                }
            }',
            new RangeMatcher(
                'field1',
                [
                    'gt' => 5,
                    'lte' => 10
                ]
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new RangeMatcher(
            'field1',
            [
                'gt' => 5,
                'lte' => 10
            ]
        );
        self::assertInstanceOf(RangeMatcher::class, $matcher1);
    }
}
