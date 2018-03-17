<?php

namespace Gskema\ElasticSearchQueryDSL\Rescorer;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;

class QueryRescorerTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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

    public function testMethods()
    {
        $rescorer = (new QueryRescorer(new TermMatcher('field1', 'value1')))
            ->setQueryWeight(1.0)
            ->setRescoreQueryWeight(2.0)
            ->setScoreMode('avg')
            ->setWindowSize(10);

        $this->assertEquals(new TermMatcher('field1', 'value1'), $rescorer->getQuery());
        $this->assertEquals(1.0, $rescorer->getQueryWeight());
        $this->assertEquals(2.0, $rescorer->getRescoreQueryWeight());
        $this->assertEquals('avg', $rescorer->getScoreMode());
        $this->assertEquals(10, $rescorer->getWindowSize());
    }
}
