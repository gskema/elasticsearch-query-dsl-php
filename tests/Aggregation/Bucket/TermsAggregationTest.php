<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class TermsAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "terms": {
                    "field": "field1",
                    "order": {
                        "_count": "asc"
                    }
                }
            }',
            TermsAggregation::fromField('field1', ['order' => ['_count' => 'asc']]),
        ];

        return $dataSets;
    }
}
