<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use InvalidArgumentException;

final class StatsAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "stats": {
                    "field": "field1"
                }
            }',
            StatsAggregation::fromField('field1'),
        ];

        return $dataSets;
    }

    public function testConstructorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class extends StatsAggregation {
            public function __construct()
            {
                parent::__construct(null, null);
            }
        };
    }
}
