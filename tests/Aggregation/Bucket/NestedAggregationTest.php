<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class NestedAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "nested": {
                    "path": "path1"
                },
                "aggs": {
                    "key1": {
                        "terms": {
                            "field": "path1.field1"
                        }
                    }
                }

            }',
            (new NestedAggregation('path1'))
                ->setAgg('key1', TermsAggregation::fromField('path1.field1')),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg = new NestedAggregation('path1');
        self::assertInstanceOf(NestedAggregation::class, $agg);
    }
}
