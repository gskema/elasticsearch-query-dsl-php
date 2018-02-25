<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class BucketSelectorAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
}
