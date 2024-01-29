<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class EmptyAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "terms": {}
            }',
            new EmptyAggregation('terms'),
        ];

        return $dataSets;
    }
}
