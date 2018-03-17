<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class FuzzyMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "fuzzy": {
                    "field1": "value1"
                }
            }',
            new FuzzyMatcher('field1', 'value1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "fuzzy": {
                    "field1": {
                        "value": "value1",
                        "max_expansions": 65
                    }
                }
            }',
            new FuzzyMatcher('field1', 'value1', [
                "max_expansions" => 65
            ]),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new FuzzyMatcher('field1', 'value1');
        $this->assertInstanceOf(FuzzyMatcher::class, $matcher1);
    }
}
