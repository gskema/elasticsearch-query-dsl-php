<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class WildcardMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "wildcard": {
                    "field1": "value1*"
                }
            }',
            new WildcardMatcher('field1', 'value1*'),
        ];

        return $dataSets;
    }
}
