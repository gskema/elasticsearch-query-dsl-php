<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Highlighter\Highlighter;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticSearchQueryDSL\Sorter\FieldSorter;
use Gskema\ElasticSearchQueryDSL\Sorter\RawSorter;
use Gskema\ElasticSearchQueryDSL\SourceFilter\DisabledSourceFilter;

class TopHitsRequestTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{ }',
            new TopHitsRequest(),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "size": 1
            }',
            (new TopHitsRequest())->setSize(1),
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            '{
                "explain": true,
                "version": true,
                "_source": false,
                "stored_fields": ["storedField1", "storedField2"],
                "script_fields": {
                    "scriptField1": "script1",
                    "scriptField2": "script2",
                    "scriptField3": "script3"
                },
                "docvalue_fields": ["docValueField1", "docValueField2"],
                "from": 10,
                "size": 5,
                "sort": [
                    { "field3": {"order": "desc"} },
                    "field4"
                ],
                "highlight": {
                    "fields": {
                        "field5": {
                            "order": "score"
                        },
                        "field6": {}
                    }
                }
            }',
            (new TopHitsRequest())
                ->setOptions([
                    'explain' => true,
                ])
                ->setOption('version', true)
                ->setSourceFields(new DisabledSourceFilter())
                ->setStoredFields(['storedField1', 'storedField2'])
                ->setScriptFields([
                    'scriptField1' => new InlineScript('script1'),
                    'scriptField2' => new InlineScript('script2'),
                ])
                ->setScriptField('scriptField3', new InlineScript('script3'))
                ->setDocValueFields(['docValueField1', 'docValueField2'])
                ->setFrom(10)
                ->setSize(5)
                ->setSorters([
                    new FieldSorter('field3', 'desc')
                ])
                ->addSorter(new RawSorter('field4'))
                ->setHighlighter(
                    (new Highlighter())
                        ->setField('field5', ['order' => 'score'])
                        ->setField('field6')
                )
        ];

        return $dataSets;
    }
}
