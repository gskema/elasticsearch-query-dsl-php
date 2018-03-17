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

    public function testMethods()
    {
        $sorter = new NestedSorter('field1', 'path1');

        $this->assertEquals('field1', $sorter->getField());
        $this->assertEquals('path1', $sorter->getNestedPath());

        $sorter->setOrder('order1');
        $sorter->setMode('mode1');
        $sorter->setNestedFilter(new MatchAllMatcher());
        $sorter->setOption('key1', 'value1');

        $this->assertEquals('order1', $sorter->getOrder());
        $this->assertEquals('mode1', $sorter->getMode());
        $this->assertEquals(new MatchAllMatcher(), $sorter->getNestedFilter());
        $this->assertEquals('value1', $sorter->getOption('key1'));
    }
}
