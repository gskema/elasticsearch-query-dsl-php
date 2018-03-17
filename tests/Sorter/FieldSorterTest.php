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

    public function testMethods()
    {
        $sorter = new FieldSorter('field1', 'order1', 'mode1');

        $this->assertEquals('field1', $sorter->getField());
        $this->assertEquals('order1', $sorter->getOrder());
        $this->assertEquals('mode1', $sorter->getMode());

        $sorter->setOrder('order2');
        $sorter->setMode('mode2');
        $sorter->setOption('key1', 'value1');

        $this->assertEquals('order2', $sorter->getOrder());
        $this->assertEquals('mode2', $sorter->getMode());
        $this->assertEquals('value1', $sorter->getOption('key1'));
    }
}
