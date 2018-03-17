<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Matrix;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MatrixStatsAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "matrix_stats": {
                    "fields": ["field1", "field2"]
                }
            }',
            new MatrixStatsAggregation(
                'field1',
                'field2'
            ),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "matrix_stats": {
                    "fields": ["field1", "field2"],
                    "mode": "avg"
                }
            }',
            (new MatrixStatsAggregation('field1', 'field2'))
                ->setOption('mode', 'avg'),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new MatrixStatsAggregation(
            'field1',
            'field2'
        );

        $this->assertInstanceOf(MatrixStatsAggregation::class, $agg);
    }
}
