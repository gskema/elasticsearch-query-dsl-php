<?php

namespace Gskema\ElasticSearchQueryDSL\Sorter;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\FileScript;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class ScriptSorterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "_script": {
                    "type": "number",
                    "script": "script1",
                    "order": "asc"
                }     
            }',
            (new ScriptSorter('number', new InlineScript('script1')))->setOrder('asc'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "_script": {
                    "type": "number",
                    "script": {
                        "file": "file1"
                    },
                    "order": "asc"
                }
                
            }',
            (new ScriptSorter('number', new FileScript('file1')))->setOrder('asc'),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $sorter = new ScriptSorter('type1', new InlineScript('source1'));

        $this->assertEquals('type1', $sorter->getType());
        $this->assertEquals(new InlineScript('source1'), $sorter->getScript());

        $sorter->setOrder('order1');
        $sorter->setMode('mode1');

        $this->assertEquals('order1', $sorter->getOrder());
        $this->assertEquals('mode1', $sorter->getMode());
    }
}
