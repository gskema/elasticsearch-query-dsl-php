<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class RangeMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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

    public function testMethods()
    {
        $matcher1 = new RangeMatcher(
            'field1',
            [
                'gt' => 5,
                'lte' => 10
            ]
        );
        $this->assertInstanceOf(RangeMatcher::class, $matcher1);
    }
}
