<?php

namespace Gskema\ElasticSearchQueryDSL;

use Gskema\ElasticSearchQueryDSL\Suggester\CandidateGenerator\DirectCandidateGenerator;
use Gskema\ElasticSearchQueryDSL\Suggester\PhraseSuggester;

class PhraseSuggesterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "text": "text1",
                "phrase": {
                    "field": "field1"
                }
            }',
            (new PhraseSuggester('field1', 'text1')),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "text": "text1",
                    "phrase": {
                        "field": "field1",
                        "direct_generator": [
                            { "field": "field1" }
                        ]
                    }
            }',
            (new PhraseSuggester('field1', 'text1'))
                ->addDirectGenerator(new DirectCandidateGenerator('field1')),
        ];

        return $dataSets;
    }
}
