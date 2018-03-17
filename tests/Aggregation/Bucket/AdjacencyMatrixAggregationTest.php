<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;
use InvalidArgumentException;

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

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "adjacency_matrix": {
                    "filters": [
                        { "term": { "field1": "value1" } },
                        { "term": { "field2": "value2" } }
                    ]
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new AdjacencyMatrixAggregation([
                new TermMatcher('field1', 'value1'),
                new TermMatcher('field2', 'value2'),
            ]))->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new AdjacencyMatrixAggregation([
            new TermMatcher('field1', 'value1'),
            new TermMatcher('field2', 'value2'),
        ]);
        $this->assertInstanceOf(AdjacencyMatrixAggregation::class, $agg);

        $this->expectException(InvalidArgumentException::class);
        new AdjacencyMatrixAggregation([]);
    }
}
