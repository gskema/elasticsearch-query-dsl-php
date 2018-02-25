<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class TypeMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
}
