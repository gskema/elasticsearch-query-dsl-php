<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use InvalidArgumentException;

final class MinAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "min": {
                    "field": "field1"
                }
            }',
            MinAggregation::fromField('field1'),
        ];

        return $dataSets;
    }

    public function testConstructorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class extends MinAggregation {
            public function __construct()
            {
                parent::__construct(null, null);
            }
        };
    }
}
