<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Model\Script\InlineScript;
use InvalidArgumentException;

final class DateHistogramAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "date_histogram": {
                    "field": "field1",
                    "interval": "1day"
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            DateHistogramAggregation::fromField(
                'field1',
                '1day'
            )->setAgg('key1', new GlobalAggregation()),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "date_histogram": {
                    "field": "field1",
                    "interval": "1day",
                    "script": "source1",
                    "missing": 0
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            DateHistogramAggregation::fromField(
                'field1',
                '1day',
                ['missing' => 0],
                new InlineScript('source1')
            )->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg1 = DateHistogramAggregation::fromField('field1', '1day', [], new InlineScript('source1'));
        self::assertInstanceOf(DateHistogramAggregation::class, $agg1);

        $agg2 = DateHistogramAggregation::fromScript(new InlineScript('source1'), '1day');
        self::assertInstanceOf(DateHistogramAggregation::class, $agg2);
    }

    public function testConstructorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class extends DateHistogramAggregation {
            public function __construct()
            {
                parent::__construct(null, null, 10);
            }
        };
    }
}
