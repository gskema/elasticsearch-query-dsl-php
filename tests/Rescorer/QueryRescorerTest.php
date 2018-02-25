<?php

namespace Gskema\ElasticSearchQueryDSL\Rescorer;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;

class QueryRescorerTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        $dataSets[] = [
            // language=JSON
            '{
                "query": {
                    "rescore_query": {
                        "term": {
                            "field1": "value1"
                        }
                    }
                }
            }',
            (new QueryRescorer(new TermMatcher('field1', 'value1')))
        ];

        return $dataSets;
    }
}
