<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Compound;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticsearchQueryDSL\Matcher\TermLevel\TermMatcher;
use Gskema\ElasticsearchQueryDSL\ScoreFunction\LinearDecayScoreFunction;
use Gskema\ElasticsearchQueryDSL\ScoreFunction\RandomScoreFunction;

final class FunctionScoreMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "function_score": {
                    "random_score" : { "seed": 99 }
                }
             }',
            (new FunctionScoreMatcher())->addScoreFunction(new RandomScoreFunction(99))
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "function_score": {
                    "query": {
                        "term": {
                            "field1": "term1"
                        }
                    },
                    "score_mode": "avg",
                    "functions": [
                        {
                            "filter": { "match_all": {} },
                            "random_score": {
                                "seed": 99
                            },
                            "weight": 5
                        },
                        {
                            "linear": {
                                "field": "field1",
                                "origin": "origin1",
                                "scale": "scale1"
                            },
                            "weight": 6
                        }
                    ]
                }
             }',
            (new FunctionScoreMatcher(
                new TermMatcher('field1', 'term1'),
                ['score_mode' => 'avg']
            ))
            ->addScoreFunction(new RandomScoreFunction(99), new MatchAllMatcher(), 5)
            ->addScoreFunction(new LinearDecayScoreFunction('field1', 'origin1', 'scale1'), null, 6)
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = (new FunctionScoreMatcher(
            new TermMatcher('field1', 'term1'),
            ['score_mode' => 'avg']
        ))
            ->addScoreFunction(new RandomScoreFunction(99), new MatchAllMatcher(), 5);
        self::assertInstanceOf(FunctionScoreMatcher::class, $matcher1);
    }
}
