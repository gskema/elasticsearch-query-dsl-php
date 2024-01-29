<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\SearchRequest\TopHits\TopHitsRequest;

final class TopHitsAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "top_hits": {
                    "size": 1
                }
            }',
            new TopHitsAggregation(
                (new TopHitsRequest())->setSize(1)
            ),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "top_hits": {}
            }',
            new TopHitsAggregation(),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $req = new TopHitsAggregation(
            (new TopHitsRequest())->setSize(1)
        );

        self::assertInstanceOf(TopHitsAggregation::class, $req);
    }
}
