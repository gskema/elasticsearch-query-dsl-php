<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class InnerHitsRequestTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{ }',
            new InnerHitsRequest(),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "size": 1
            }',
            (new InnerHitsRequest())->setSize(1),
        ];

        return $dataSets;
    }
}
