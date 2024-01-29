<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Matcher\MatchAllMatcher;

final class FilterAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $agg = new FilterAggregation(new MatchAllMatcher());
        self::assertInstanceOf(FilterAggregation::class, $agg);
    }
}
