<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

final class BucketScriptAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "bucket_script": {
                    "buckets_path": {
                        "var1": "path1",
                        "var2": "path2"
                    },
                    "script": "params.var1 / params.var2"
                }
            }',
            new BucketScriptAggregation(
                [
                    'var1' => 'path1',
                    'var2' => 'path2'
                ],
                new InlineScript('params.var1 / params.var2')
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg = new BucketScriptAggregation(
            [
                'var1' => 'path1',
                'var2' => 'path2'
            ],
            new InlineScript('params.var1 / params.var2')
        );

        self::assertInstanceOf(BucketScriptAggregation::class, $agg);
    }
}
