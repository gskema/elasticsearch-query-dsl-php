<?php

namespace Gskema\ElasticsearchQueryDSL\Sorter;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Matcher\MatchAllMatcher;
use stdClass;

final class NestedSorterTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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
                    "mode": "max",
                    "order": "desc"
                }
            }',
            (new NestedSorter('field1', 'path1'))
                ->setMode('max')
                ->setNestedFilter(new MatchAllMatcher())
                ->setOrder('desc'),
            new stdClass(),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $sorter = new NestedSorter('field1', 'path1');

        self::assertEquals('field1', $sorter->getField());
        self::assertEquals('path1', $sorter->getNestedPath());

        $sorter->setOrder('order1');
        $sorter->setMode('mode1');
        $sorter->setNestedFilter(new MatchAllMatcher());
        $sorter->setOption('key1', 'value1');

        self::assertEquals('order1', $sorter->getOrder());
        self::assertEquals('mode1', $sorter->getMode());
        self::assertEquals(new MatchAllMatcher(), $sorter->getNestedFilter());
        self::assertEquals('value1', $sorter->getOption('key1'));
    }
}
