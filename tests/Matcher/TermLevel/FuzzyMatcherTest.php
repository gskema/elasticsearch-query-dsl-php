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

        return $dataSets;
    }
}
