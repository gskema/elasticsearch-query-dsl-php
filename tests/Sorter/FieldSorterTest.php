<?php

namespace Gskema\ElasticSearchQueryDSL\Sorter;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class FieldSorterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '"field1"',
            new FieldSorter('field1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "field1": {
                    "mode": "avg",
                    "order": "desc"
                }
            }',
            (new FieldSorter('field1'))->setMode('avg')->setOrder('desc')
        ];

        return $dataSets;
    }
}
