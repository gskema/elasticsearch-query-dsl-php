<?php

namespace Gskema\ElasticSearchQueryDSL\Sorter;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;

class NestedSorterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "field1": {
                    "nested_path": "path1",
                    "mode": "max"
                }
            }',
            (new NestedSorter('field1', 'path1'))->setMode('max'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "field1" : {
                    "nested_path": "path1",
                    "nested_filter": {
                        "match_all": {}
                    },
                    "mode": "max"
                }
            }',
            (new NestedSorter('field1', 'path1'))
                ->setMode('max')
                ->setNestedFilter(new MatchAllMatcher()),
            new \stdClass(),
        ];

        return $dataSets;
    }
}
