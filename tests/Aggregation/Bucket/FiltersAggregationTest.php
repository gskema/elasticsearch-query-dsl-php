<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;

final class FiltersAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $agg = new FiltersAggregation([
            'filter1' => new TermMatcher('field1', 'value1'),
            'filter2' => new TermMatcher('field2', 'value2'),
        ]);
        self::assertInstanceOf(FiltersAggregation::class, $agg);
    }
}
