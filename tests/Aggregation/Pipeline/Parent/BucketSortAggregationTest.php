<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Sorter\FieldSorter;

final class BucketSortAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "bucket_sort": {
                    "sort": "field1",
                    "size": 12,
                    "from": 10
                }
            }',
            new BucketSortAggregation([new FieldSorter('field1')], 10, 12)
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $obj = new BucketSortAggregation([new FieldSorter('field1')], 10, 12);
        self::assertInstanceOf(BucketSortAggregation::class, $obj);
    }
}
