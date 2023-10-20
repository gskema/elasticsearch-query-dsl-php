<?php

namespace Gskema\ElasticSearchQueryDSL\Sorter;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\FileScript;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

final class ScriptSorterTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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
                    "order": "asc",
                    "mode": "avg"
                }

            }',
            (new ScriptSorter('number', new FileScript('file1')))
                ->setOrder('asc')
                ->setMode('avg'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $sorter = new ScriptSorter('type1', new InlineScript('source1'));

        self::assertEquals('type1', $sorter->getType());
        self::assertEquals(new InlineScript('source1'), $sorter->getScript());

        $sorter->setOrder('order1');
        $sorter->setMode('mode1');

        self::assertEquals('order1', $sorter->getOrder());
        self::assertEquals('mode1', $sorter->getMode());
    }
}
