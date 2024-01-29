<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Matrix;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class MatrixStatsAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $agg = new MatrixStatsAggregation(
            'field1',
            'field2'
        );

        self::assertInstanceOf(MatrixStatsAggregation::class, $agg);
    }
}
