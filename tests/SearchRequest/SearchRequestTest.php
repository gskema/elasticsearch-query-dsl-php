<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Aggregation\Bucket\FilterAggregation;
use Gskema\ElasticSearchQueryDSL\Aggregation\Bucket\TermsAggregation;
use Gskema\ElasticSearchQueryDSL\Aggregation\Metric\MaxAggregation;
use Gskema\ElasticSearchQueryDSL\FieldCollapser\FieldCollapser;
use Gskema\ElasticSearchQueryDSL\Highlighter\Highlighter;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchNoneMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\WildcardMatcher;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticSearchQueryDSL\Rescorer\QueryRescorer;
use Gskema\ElasticSearchQueryDSL\Sorter\FieldSorter;
use Gskema\ElasticSearchQueryDSL\Sorter\RawSorter;
use Gskema\ElasticSearchQueryDSL\SourceFilter\DisabledSourceFilter;
use Gskema\ElasticSearchQueryDSL\Suggester\PhraseSuggester;
use Gskema\ElasticSearchQueryDSL\Suggester\TermSuggester;

final class SearchRequestTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{ }',
            new SearchRequest(),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "size": 1
            }',
            (new SearchRequest())->setSize(1),
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
                "query": {
                    "term": {
                        "field1": "value1"
                    }
                },
                "post_filter": {
                    "wildcard": {
                        "field2": "value*"
                    }
                },
                "sort": [
                    { "field3": {"order": "desc"} },
                    "field4"
                ],
                "rescore": [
                    {
                        "query": {
                            "rescore_query": { "match_all": {} },
                             "score_mode": "avg"
                        }
                    },
                    {
                        "query": {
                            "rescore_query": { "match_none": {} }
                        }
                    }
                ],
                "highlight": {
                    "fields": {
                        "field5": {
                            "order": "score"
                        },
                        "field6": {}
                    }
                },
                "suggest": {
                    "suggesterKey1": {
                        "text": "text1",
                        "term": {
                            "field": "field7"
                        }
                    },
                    "suggesterKey2": {
                        "text": "text2",
                        "phrase": {
                            "field": "field8"
                        }
                    }
                },
                "stats": ["statGroup1", "statGroup2", "statGroup3"],
                "collapse": {
                    "field": "field9"
                },
                "aggs": {
                    "agg1": {
                        "filter": { "match_all": {} },
                        "aggs": {
                            "agg2": {
                                "terms": {
                                    "field": "field10"
                                }
                            }
                        }
                    },
                    "agg3": {
                        "max": {
                            "field": "field11"
                        }
                    }
                }
            }',
            (new SearchRequest())
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
            ->setQuery(new TermMatcher('field1', 'value1'))
            ->setPostFilter(new WildcardMatcher('field2', 'value*'))
            ->setSorters([
                new FieldSorter('field3', 'desc')
            ])
            ->addSorter(new RawSorter('field4'))
            ->setRescorers([
                (new QueryRescorer(new MatchAllMatcher()))->setScoreMode('avg')
            ])
            ->addRescorer(new QueryRescorer(new MatchNoneMatcher()))
            ->setHighlighter(
                (new Highlighter())
                    ->setField('field5', ['order' => 'score'])
                    ->setField('field6')
            )
            ->setSuggesters([
                'suggesterKey1' => new TermSuggester('field7', 'text1')
            ])
            ->setSuggester('suggesterKey2', new PhraseSuggester('field8', 'text2'))
            ->setStatGroups(['statGroup1', 'statGroup2'])
            ->addStatGroup('statGroup3')
            ->setFieldCollapser(
                (new FieldCollapser('field9'))
            )
            ->setAggs([
                'agg1' => (new FilterAggregation(new MatchAllMatcher()))
                          ->setAgg('agg2', TermsAggregation::fromField('field10'))
            ])
            ->setAgg('agg3', MaxAggregation::fromField('field11'))
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $req = (new SearchRequest())
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
            ->setQuery(new TermMatcher('field1', 'value1'))
            ->setPostFilter(new WildcardMatcher('field2', 'value*'))
            ->setSorters([
                new FieldSorter('field3', 'desc')
            ])
            ->addSorter(new RawSorter('field4'))
            ->setRescorers([
                (new QueryRescorer(new MatchAllMatcher()))->setScoreMode('avg')
            ])
            ->addRescorer(new QueryRescorer(new MatchNoneMatcher()))
            ->setHighlighter(
                (new Highlighter())
                    ->setField('field5', ['order' => 'score'])
                    ->setField('field6')
            )
            ->setSuggesters([
                'suggesterKey1' => new TermSuggester('field7', 'text1')
            ])
            ->setSuggester('suggesterKey2', new PhraseSuggester('field8', 'text2'))
            ->setStatGroups(['statGroup1', 'statGroup2'])
            ->addStatGroup('statGroup3')
            ->setFieldCollapser(
                (new FieldCollapser('field9'))
            )
            ->setAggs([
                'agg1' => (new FilterAggregation(new MatchAllMatcher()))
                    ->setAgg('agg2', TermsAggregation::fromField('field10'))
            ])
            ->setAgg('agg3', MaxAggregation::fromField('field11'));

        self::assertEquals(true, $req->getOption('explain'));
        self::assertEquals(true, $req->getOption('version'));
        self::assertEquals(new DisabledSourceFilter(), $req->getSourceFields());
        self::assertEquals(['storedField1', 'storedField2'], $req->getStoredFields());
        self::assertEquals([
            'scriptField1' => new InlineScript('script1'),
            'scriptField2' => new InlineScript('script2'),
            'scriptField3' => new InlineScript('script3'),
        ], $req->getScriptFields());
        self::assertEquals(['docValueField1', 'docValueField2'], $req->getDocValueFields());
        self::assertEquals(10, $req->getFrom());
        self::assertEquals(5, $req->getSize());
        self::assertEquals(new TermMatcher('field1', 'value1'), $req->getQuery());
        self::assertEquals(new WildcardMatcher('field2', 'value*'), $req->getPostFilter());
        self::assertEquals([
            new FieldSorter('field3', 'desc'),
            new RawSorter('field4'),
        ], $req->getSorters());
        self::assertEquals([
            (new QueryRescorer(new MatchAllMatcher()))->setScoreMode('avg'),
            new QueryRescorer(new MatchNoneMatcher()),
        ], $req->getRescorers());
        self::assertEquals(
            (new Highlighter())
            ->setField('field5', ['order' => 'score'])
            ->setField('field6'),
            $req->getHighlighter()
        );
        self::assertEquals([
            'suggesterKey1' => new TermSuggester('field7', 'text1'),
            'suggesterKey2' => new PhraseSuggester('field8', 'text2'),
        ], $req->getSuggesters());
        self::assertEquals(['statGroup1', 'statGroup2', 'statGroup3'], $req->getStatGroups());
        self::assertEquals(new FieldCollapser('field9'), $req->getFieldCollapser());
        self::assertEquals([
            'agg1' => (new FilterAggregation(new MatchAllMatcher()))
                ->setAgg('agg2', TermsAggregation::fromField('field10')),
            'agg3' => MaxAggregation::fromField('field11')
        ], $req->getAggs());
    }
}
