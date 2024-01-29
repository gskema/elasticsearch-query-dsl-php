<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Model\Script\InlineScript;

final class MovingFunctionAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "moving_fn": {
                    "buckets_path": "path1",
                    "window": 10,
                    "script": "script1"
                }
            }',
            new MovingFunctionAggregation('path1', 10, new InlineScript('script1'))
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $obj = new MovingFunctionAggregation('path1', 10, new InlineScript('script1'));
        self::assertInstanceOf(MovingFunctionAggregation::class, $obj);
    }
}
