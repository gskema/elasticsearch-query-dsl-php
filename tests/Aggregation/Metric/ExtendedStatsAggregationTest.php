<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use InvalidArgumentException;

final class ExtendedStatsAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "extended_stats": {
                    "field": "field1"
                }
            }',
            ExtendedStatsAggregation::fromField('field1'),
        ];

        return $dataSets;
    }

    public function testConstructorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class extends ExtendedStatsAggregation {
            public function __construct()
            {
                parent::__construct(null, null);
            }
        };
    }
}
