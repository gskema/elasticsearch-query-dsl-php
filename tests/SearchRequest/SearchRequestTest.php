<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class SearchRequestTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{ }',
            new SearchRequest(),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "size": 1
            }',
            (new SearchRequest())->setSize(1),
        ];

        return $dataSets;
    }
}
