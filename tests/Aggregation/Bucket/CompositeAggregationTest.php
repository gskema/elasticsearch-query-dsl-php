<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class CompositeAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "composite": {
                    "sources": [
                      { "agg1":  { "terms": { "field": "field1" } } },
                      { "agg2":  { "terms": { "field": "field2" } } }
                    ],
                    "size": 10
                },
                "aggs": {
                  "agg1": {
                    "global": {}
                  }
                }
            }',
            (new CompositeAggregation([
                ['agg1' => TermsAggregation::fromField('field1')],
                ['agg2' => TermsAggregation::fromField('field2')]
            ], ['size' => 10]))
                ->setAgg('agg1', new GlobalAggregation())
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $obj = (new CompositeAggregation([
            ['agg1' => TermsAggregation::fromField('field1')],
            ['agg2' => TermsAggregation::fromField('field2')]
        ], ['size' => 10]))
            ->setAgg('agg1', new GlobalAggregation());

        self::assertInstanceOf(CompositeAggregation::class, $obj);
    }
}
