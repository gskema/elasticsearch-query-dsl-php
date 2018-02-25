<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;

class AdjacencyMatrixAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "adjacency_matrix": {
                    "filters": [
                        { "term": { "field1": "value1" } },
                        { "term": { "field2": "value2" } }
                    ]
                }
            }',
            new AdjacencyMatrixAggregation([
                new TermMatcher('field1', 'value1'),
                new TermMatcher('field2', 'value2'),
            ]),
        ];

        return $dataSets;
    }
}
