<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use InvalidArgumentException;

final class PercentileRanksAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "percentile_ranks": {
                    "field": "field1",
                    "values": [1, 2, 3]
                }
            }',
            PercentileRanksAggregation::fromField(
                'field1',
                [1, 2, 3]
            ),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "percentile_ranks": {
                    "field": "field1",
                    "values": [1, 2, 3],
                    "keyed": true,
                    "script": "source1"
                }
            }',
            PercentileRanksAggregation::fromField(
                'field1',
                [1, 2, 3],
                ['keyed' => true],
                new InlineScript('source1')
            ),
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            '{
                "percentile_ranks": {
                    "values": [1, 2, 3],
                    "keyed": true,
                    "script": "source1"
                }
            }',
            PercentileRanksAggregation::fromScript(
                [1, 2, 3],
                new InlineScript('source1'),
                ['keyed' => true]
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg1 = PercentileRanksAggregation::fromField(
            'field1',
            ['value1', 'value2'],
            ['keyed' => true],
            new InlineScript('source1')
        );
        self::assertInstanceOf(PercentileRanksAggregation::class, $agg1);

        $agg2 = PercentileRanksAggregation::fromScript(
            ['value1', 'value2'],
            new InlineScript('source1'),
            ['keyed' => true]
        );
        self::assertInstanceOf(PercentileRanksAggregation::class, $agg2);
    }

    public function testConstructorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class extends PercentileRanksAggregation {
            public function __construct()
            {
                parent::__construct(null, null, []);
            }
        };
    }
}
