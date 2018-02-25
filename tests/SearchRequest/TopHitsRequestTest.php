<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class TopHitsRequestTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{ }',
            new TopHitsRequest(),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "size": 1
            }',
            (new TopHitsRequest())->setSize(1),
        ];

        return $dataSets;
    }
}
