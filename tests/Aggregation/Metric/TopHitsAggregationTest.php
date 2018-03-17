<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\SearchRequest\TopHitsRequest;

class TopHitsAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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

    public function testMethods()
    {
        $req = new TopHitsAggregation(
            (new TopHitsRequest())->setSize(1)
        );

        $this->assertInstanceOf(TopHitsAggregation::class, $req);
    }
}
