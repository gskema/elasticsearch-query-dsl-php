<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class BucketScriptAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
}
