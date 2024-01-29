<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Model\Script\InlineScript;
use InvalidArgumentException;

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

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "diversified_sampler" : {
                    "script": "script1"
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            DiversifiedSamplerAggregation::fromScript(new InlineScript('script1'))
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

    public function testConstructorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class extends DiversifiedSamplerAggregation {
            public function __construct()
            {
                parent::__construct(null, null);
            }
        };
    }
}
