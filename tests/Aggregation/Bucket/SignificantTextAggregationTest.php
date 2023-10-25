<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchNoneMatcher;

final class SignificantTextAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "significant_text": {
                    "field": "field1",
                    "size": 3
                },
                "aggs": {
                  "agg1": {
                    "global": {}
                  }
                }
            }',
            (new SignificantTextAggregation('field1', ['size' => 3]))
                ->setAgg('agg1', new GlobalAggregation())
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $obj = (new SignificantTextAggregation('field1', [
            'size' => 3,
            'background_filter' => new MatchNoneMatcher()
        ]))->setAgg('agg1', new GlobalAggregation());

        $string = json_encode($obj->jsonSerialize());
        self::assertIsString($string);

        self::assertInstanceOf(SignificantTextAggregation::class, $obj);
    }
}
