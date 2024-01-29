<?php

namespace Gskema\ElasticsearchQueryDSL\Sorter;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class FieldSorterTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $sorter = new FieldSorter('field1', 'order1', 'mode1');

        self::assertEquals('field1', $sorter->getField());
        self::assertEquals('order1', $sorter->getOrder());
        self::assertEquals('mode1', $sorter->getMode());

        $sorter->setOrder('order2');
        $sorter->setMode('mode2');
        $sorter->setOption('key1', 'value1');

        self::assertEquals('order2', $sorter->getOrder());
        self::assertEquals('mode2', $sorter->getMode());
        self::assertEquals('value1', $sorter->getOption('key1'));
    }
}
