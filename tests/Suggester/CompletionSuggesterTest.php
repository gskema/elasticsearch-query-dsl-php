<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class CompletionSuggesterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "prefix": "prefix1",
                "completion": {
                    "field": "field1"
                }
            }',
            CompletionSuggester::fromPrefix('field1', 'prefix1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "regex": "regex1",
                "completion": {
                    "field": "field1"
                }
            }',
            CompletionSuggester::fromRegex('field1', 'regex1'),
        ];

        return $dataSets;
    }
}
