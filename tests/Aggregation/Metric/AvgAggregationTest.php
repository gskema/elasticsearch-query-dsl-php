<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use InvalidArgumentException;

final class AvgAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "avg": {
                    "field": "field1"
                }
            }',
            AvgAggregation::fromField('field1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "avg": {
                    "script": "source1"
                }
            }',
            AvgAggregation::fromScript(new InlineScript('source1')),
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            '{
                "avg": {
                    "field": "field1",
                    "missing": 0,
                    "script": "source1"
                }
            }',
            AvgAggregation::fromField('field1', ['missing' => 0], new InlineScript('source1')),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg1 = AvgAggregation::fromField('field1', ['missing' => 0], new InlineScript('source1'));
        self::assertInstanceOf(AvgAggregation::class, $agg1);

        $agg2 = AvgAggregation::fromScript(new InlineScript('source1'));
        self::assertInstanceOf(AvgAggregation::class, $agg2);
    }

    public function testConstructorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class extends AvgAggregation {
            public function __construct()
            {
                parent::__construct(null, null);
            }
        };
    }
}
