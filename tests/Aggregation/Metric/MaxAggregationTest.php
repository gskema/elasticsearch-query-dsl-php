<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use InvalidArgumentException;

final class MaxAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "max": {
                    "field": "field1"
                }
            }',
            MaxAggregation::fromField('field1'),
        ];

        return $dataSets;
    }

    public function testConstructorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class extends MaxAggregation {
            public function __construct()
            {
                parent::__construct(null, null);
            }
        };
    }
}
