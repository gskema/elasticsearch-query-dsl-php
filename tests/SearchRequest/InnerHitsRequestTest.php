<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Highlighter\Highlighter;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticSearchQueryDSL\Sorter\FieldSorter;
use Gskema\ElasticSearchQueryDSL\Sorter\RawSorter;
use Gskema\ElasticSearchQueryDSL\SourceFilter\DisabledSourceFilter;

class InnerHitsRequestTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{ }',
            new InnerHitsRequest(),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "size": 1
            }',
            (new InnerHitsRequest())->setSize(1),
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            '{
                "name": "name1",
                "explain": true,
                "version": true,
                "_source": false,
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
            (new InnerHitsRequest())
                ->setName('name1')
                ->setOptions([
                    'explain' => true,
                ])
                ->setOption('version', true)
                ->setSourceFields(new DisabledSourceFilter())
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

    public function testMethods()
    {
        $req = (new InnerHitsRequest())
            ->setName('name1')
            ->setOptions([
                'explain' => true,
            ])
            ->setOption('version', true)
            ->setSourceFields(new DisabledSourceFilter())
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
            );

        $this->assertEquals('name1', $req->getName());
        $this->assertEquals(true, $req->getOption('explain'));
        $this->assertEquals(true, $req->getOption('version'));
        $this->assertEquals(new DisabledSourceFilter(), $req->getSourceFields());
        $this->assertEquals([
            'scriptField1' => new InlineScript('script1'),
            'scriptField2' => new InlineScript('script2'),
            'scriptField3' => new InlineScript('script3'),
        ], $req->getScriptFields());
        $this->assertEquals(['docValueField1', 'docValueField2'], $req->getDocValueFields());
        $this->assertEquals(10, $req->getFrom());
        $this->assertEquals(5, $req->getSize());
        $this->assertEquals([
            new FieldSorter('field3', 'desc'),
            new RawSorter('field4')
        ], $req->getSorters());
        $this->assertEquals(
            (new Highlighter())
                ->setField('field5', ['order' => 'score'])
                ->setField('field6'),
            $req->getHighlighter()
        );
    }
}
