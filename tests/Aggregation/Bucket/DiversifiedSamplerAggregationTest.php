<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

final class DiversifiedSamplerAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "diversified_sampler" : {
                    "field": "field1"
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            DiversifiedSamplerAggregation::fromField('field1')
                ->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg1 = DiversifiedSamplerAggregation::fromField('field1');
        self::assertInstanceOf(DiversifiedSamplerAggregation::class, $agg1);

        $agg2 = DiversifiedSamplerAggregation::fromScript(new InlineScript('source1'));
        self::assertInstanceOf(DiversifiedSamplerAggregation::class, $agg2);
    }
}
