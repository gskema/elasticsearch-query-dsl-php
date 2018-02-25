<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class NestedAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "nested": {
                    "path": "path1"
                },
                "aggs": {
                    "key1": {
                        "terms": {
                            "field": "path1.field1"
                        }
                    }
                }
               
            }',
            (new NestedAggregation('path1'))
            ->setAgg('key1', TermsAggregation::fromField('path1.field1')),
        ];

        return $dataSets;
    }
}
