<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class LookupTermsMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "terms": {
                    "field1": {
                        "index": "index1",
                        "type": "type1",
                        "id": "id1",
                        "path": "path1"
                    }
                }
            }',
            new LookupTermsMatcher(
                'field1',
                'index1',
                'type1',
                'id1',
                'path1'
            ),
        ];

        return $dataSets;
    }
}
