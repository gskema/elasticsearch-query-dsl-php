<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class EmptyAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
