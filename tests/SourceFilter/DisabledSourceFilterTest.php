<?php

namespace Gskema\ElasticsearchQueryDSL\SourceFilter;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

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
