<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;
use Gskema\ElasticSearchQueryDSL\ScoreFunction\LinearDecayScoreFunction;
use Gskema\ElasticSearchQueryDSL\ScoreFunction\RandomScoreFunction;

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
