<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class TermSuggesterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "text": "text1",
                "term": {
                    "field": "field1"
                }
            }',
            (new TermSuggester('field1', 'text1')),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "text": "text1",
                "term": {
                    "field": "field1",
                    "shard_size": 5
                }
            }',
            (new TermSuggester('field1', 'text1'))->setOption('shard_size', 5),
        ];

        return $dataSets;
    }
}
