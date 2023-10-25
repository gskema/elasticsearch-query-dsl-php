<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

final class MedianAbsoluteDeviationAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "median_absolute_deviation": {
                    "field": "field1",
                    "missing": 1
                }
            }',
            new MedianAbsoluteDeviationAggregation('field1', ['missing' => 1])
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "median_absolute_deviation": {
                    "script": "script1",
                    "missing": 1
                }
            }',
            new MedianAbsoluteDeviationAggregation(new InlineScript('script1'), ['missing' => 1])
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $obj = new MedianAbsoluteDeviationAggregation(new InlineScript('script1'), ['missing' => 1]);
        self::assertInstanceOf(MedianAbsoluteDeviationAggregation::class, $obj);
    }
}
