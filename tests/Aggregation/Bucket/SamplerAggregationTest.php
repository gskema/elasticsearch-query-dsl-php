<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class SamplerAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "sampler": {},
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new SamplerAggregation())->setAgg('key1', new GlobalAggregation()),
        ];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "sampler": {
                    "shard_size": 100
                }
            }',
            (new SamplerAggregation())->setOption('shard_size', 100),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg = new SamplerAggregation();
        self::assertInstanceOf(SamplerAggregation::class, $agg);
    }
}
