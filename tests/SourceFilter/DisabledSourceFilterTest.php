<?php

namespace Gskema\ElasticSearchQueryDSL\SourceFilter;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class DisabledSourceFilterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            'false',
            new DisabledSourceFilter(),
        ];

        return $dataSets;
    }
}
