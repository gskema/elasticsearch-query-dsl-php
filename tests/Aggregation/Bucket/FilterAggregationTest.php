<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;

class FilterAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "filter": { "match_all": {} },
                "aggs": {
                    "key1": {
                        "children": {
                            "type": "childrenType1"
                        }
                    }
                }
            }',
            (new FilterAggregation(new MatchAllMatcher()))
                ->setAgg('key1', new ChildrenAggregation('childrenType1')),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new FilterAggregation(new MatchAllMatcher());
        $this->assertInstanceOf(FilterAggregation::class, $agg);
    }
}
