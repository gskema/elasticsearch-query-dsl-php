<?php

namespace Gskema\ElasticSearchQueryDSL\SourceFilter;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class DisabledSourceFilterTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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
