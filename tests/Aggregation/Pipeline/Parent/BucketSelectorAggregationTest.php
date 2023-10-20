<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

final class BucketSelectorAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "bucket_selector": {
                    "buckets_path": {
                        "var1": "path1",
                        "var2": "path2"
                    },
                    "script": "params.var1 > params.var2"
                }
            }',
            new BucketSelectorAggregation(
                [
                    'var1' => 'path1',
                    'var2' => 'path2'
                ],
                new InlineScript('params.var1 > params.var2')
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg = new BucketSelectorAggregation(
            [
                'var1' => 'path1',
                'var2' => 'path2'
            ],
            new InlineScript('params.var1 > params.var2')
        );

        self::assertInstanceOf(BucketSelectorAggregation::class, $agg);
    }
}
