<?php

namespace Gskema\ElasticSearchQueryDSL\Highlighter;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchNoneMatcher;

class HighlighterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "fields": {
                    "field1": {}
                }
            }',
            (new Highlighter())->setField('field1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "type": "plain",
                "fields": {
                    "field1": {}
                }
            }',
            (new Highlighter(['type' => 'plain']))->setField('field1'),
        ];

        //# 2
        $dataSets[] = [
            // language=JSON
            '{
                "type": "plain",
                "fields": {
                    "field1": {
                        "order": "score"
                    }
                }
            }',
            (new Highlighter(['type' => 'plain']))->setField('field1', ['order' => 'score']),
        ];

        // #3
        $dataSets[] = [
            // language=JSON
            '{
                "type": "plain",
                "highlight_query": {
                    "match_all" : {}
                },
                "fields": {
                    "field1": {
                        "order": "score",
                        "highlight_query": {
                            "match_none" : {}
                        }
                    }
                }
            }',
            (new Highlighter([
                'type' => 'plain',
                'highlight_query' => new MatchAllMatcher(),
            ]))->setField('field1', ['order' => 'score', 'highlight_query' => new MatchNoneMatcher()]),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $highlighter = (new Highlighter([
            'type' => 'plain',
            'highlight_query' => new MatchAllMatcher(),
        ]))->setField('field1', ['order' => 'score', 'highlight_query' => new MatchNoneMatcher()]);

        $this->assertInstanceOf(Highlighter::class, $highlighter);
    }
}
