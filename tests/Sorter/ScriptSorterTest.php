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
}
