<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Model\Script\InlineScript;
use InvalidArgumentException;

final class AutoIntervalDateHistogramAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "auto_date_histogram": {
                    "field": "field1",
                    "buckets": 10,
                    "format": "yyyy-MM-dd"
                },
                "aggs": {
                  "agg1": {
                    "global": {}
                  }
                }
            }',
            (AutoIntervalDateHistogramAggregation::fromField('field1', 10, ['format' => 'yyyy-MM-dd']))
                ->setAgg('agg1', new GlobalAggregation())
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "auto_date_histogram": {
                    "field": "field1",
                    "script": "script1",
                    "buckets": 10,
                    "format": "yyyy-MM-dd"
                },
                "aggs": {
                  "agg1": {
                    "global": {}
                  }
                }
            }',
            AutoIntervalDateHistogramAggregation::fromField(
                'field1',
                10,
                ['format' => 'yyyy-MM-dd'],
                new InlineScript('script1'),
            )->setAgg('agg1', new GlobalAggregation())
        ];


        // #2
        $dataSets[] = [
            // language=JSON
            '{
                "auto_date_histogram": {

                    "script": "script1",
                    "buckets": 10,
                    "format": "yyyy-MM-dd"
                },
                "aggs": {
                  "agg1": {
                    "global": {}
                  }
                }
            }',
            AutoIntervalDateHistogramAggregation::fromScript(
                new InlineScript('script1'),
                10,
                ['format' => 'yyyy-MM-dd'],
            )->setAgg('agg1', new GlobalAggregation())
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $obj1 = AutoIntervalDateHistogramAggregation::fromField(
            'field1',
            10,
            ['format' => 'yyyy-MM-dd']
        )->setAgg('agg1', new GlobalAggregation());

        self::assertInstanceOf(AutoIntervalDateHistogramAggregation::class, $obj1);

        $obj2 = AutoIntervalDateHistogramAggregation::fromScript(
            new InlineScript('script1'),
            10,
            ['format' => 'yyyy-MM-dd'],
        )->setAgg('agg1', new GlobalAggregation());

        self::assertInstanceOf(AutoIntervalDateHistogramAggregation::class, $obj2);
    }

    public function testConstructorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class extends AutoIntervalDateHistogramAggregation {
            public function __construct()
            {
                parent::__construct(null, null, 10, []);
            }
        };
    }
}
