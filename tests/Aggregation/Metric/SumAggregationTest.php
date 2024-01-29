<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use InvalidArgumentException;

final class SumAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "sum": {
                    "field": "field1"
                }
            }',
            SumAggregation::fromField('field1'),
        ];

        return $dataSets;
    }

    public function testConstructorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class extends SumAggregation {
            public function __construct()
            {
                parent::__construct(null, null);
            }
        };
    }
}
