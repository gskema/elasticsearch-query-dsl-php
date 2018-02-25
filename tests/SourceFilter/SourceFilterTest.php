<?php

namespace Gskema\ElasticSearchQueryDSL\SourceFilter;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class SourceFilterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{ }',
            new SourceFilter()
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '"field1"',
            (new SourceFilter())->addInclude('field1')
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            '["field1","field2"]',
            (new SourceFilter())->addInclude('field1')->addInclude('field2')
        ];

        // #3
        $dataSets[] = [
            // language=JSON
            '{
                "includes": "field1",
                "excludes": "field2"
            }',
            (new SourceFilter())->addInclude('field1')->addExclude('field2')
        ];

        // #4
        $dataSets[] = [
            // language=JSON
            '{
                "excludes": "field2"
            }',
            (new SourceFilter())->addExclude('field2')
        ];

        return $dataSets;
    }
}
