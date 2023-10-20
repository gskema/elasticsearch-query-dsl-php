<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;
use InvalidArgumentException;

final class AdjacencyMatrixAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $agg = new AdjacencyMatrixAggregation([
            new TermMatcher('field1', 'value1'),
            new TermMatcher('field2', 'value2'),
        ]);
        self::assertInstanceOf(AdjacencyMatrixAggregation::class, $agg);

        $this->expectException(InvalidArgumentException::class);
        new AdjacencyMatrixAggregation([]);
    }
}
