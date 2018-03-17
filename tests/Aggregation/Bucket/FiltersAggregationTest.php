<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;

class FiltersAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "filters": {
                    "filters": {
                        "filter1": { "term": { "field1": "value1" } },
                        "filter2": { "term": { "field2": "value2" } }
                    }
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new FiltersAggregation([
                'filter1' => new TermMatcher('field1', 'value1'),
                'filter2' => new TermMatcher('field2', 'value2')
            ]))->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new FiltersAggregation([
            'filter1' => new TermMatcher('field1', 'value1'),
            'filter2' => new TermMatcher('field2', 'value2'),
        ]);
        $this->assertInstanceOf(FiltersAggregation::class, $agg);
    }
}
