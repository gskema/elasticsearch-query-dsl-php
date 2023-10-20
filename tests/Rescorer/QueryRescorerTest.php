<?php

namespace Gskema\ElasticSearchQueryDSL\Rescorer;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;

final class QueryRescorerTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        $dataSets[] = [
            // language=JSON
            '{
                "window_size": 10,
                "query": {
                    "query_weight": 1.0,
                    "rescore_query_weight": 2.0,
                    "score_mode": "avg",
                    "rescore_query": {
                        "term": {
                            "field1": "value1"
                        }
                    }
                }
            }',
            (new QueryRescorer(new TermMatcher('field1', 'value1')))
                ->setQueryWeight(1.0)
                ->setRescoreQueryWeight(2.0)
                ->setScoreMode('avg')
                ->setWindowSize(10),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $rescorer = (new QueryRescorer(new TermMatcher('field1', 'value1')))
            ->setQueryWeight(1.0)
            ->setRescoreQueryWeight(2.0)
            ->setScoreMode('avg')
            ->setWindowSize(10);

        self::assertEquals(new TermMatcher('field1', 'value1'), $rescorer->getQuery());
        self::assertEquals(1.0, $rescorer->getQueryWeight());
        self::assertEquals(2.0, $rescorer->getRescoreQueryWeight());
        self::assertEquals('avg', $rescorer->getScoreMode());
        self::assertEquals(10, $rescorer->getWindowSize());
    }
}
