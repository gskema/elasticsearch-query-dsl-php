<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class DiversifiedSamplerAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "diversified_sampler" : {
                    "field": "field1"
                }
            }',
            DiversifiedSamplerAggregation::fromField('field1'),
        ];

        return $dataSets;
    }
}
