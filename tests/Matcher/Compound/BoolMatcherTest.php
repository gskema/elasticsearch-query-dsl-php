<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;

final class BoolMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "bool": {}
            }',
            new BoolMatcher(),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "bool": {
                    "filter": [
                        { "term" : { "field1": "value1" } },
                        { "term" : { "field2": "value2" } }
                    ],
                    "must_not": { "match_all": {} }
                }
            }',
            (new BoolMatcher())
            ->addFilter(new TermMatcher('field1', 'value1'))
            ->addFilter(new TermMatcher('field2', 'value2'))
            ->addMustNot(new MatchAllMatcher()),
        ];


        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "bool": {
                    "must": [
                        { "term" : { "field1": "value1" } },
                        { "term" : { "field2": "value2" } }
                    ],
                    "should": { "match_all": {} },
                    "minimum_should_match": 1
                }
            }',
            (new BoolMatcher())
                ->addMust(new TermMatcher('field1', 'value1'))
                ->addMust(new TermMatcher('field2', 'value2'))
                ->addShould(new MatchAllMatcher())
                ->setMinimumShouldMatch(1),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher = (new BoolMatcher())
            ->setFilters([new TermMatcher('field1', 'value1')])
            ->addFilter(new TermMatcher('field2', 'value2'))
            ->setMusts([new TermMatcher('field3', 'value3')])
            ->addMust(new TermMatcher('field4', 'value4'))
            ->setMustNots([new TermMatcher('field5', 'value5')])
            ->addMustNot(new TermMatcher('field6', 'value6'))
            ->setShoulds([new TermMatcher('field7', 'value7')])
            ->addShould(new TermMatcher('field8', 'value8'))
            ->setMinimumShouldMatch(1);

        self::assertEquals([
            new TermMatcher('field1', 'value1'),
            new TermMatcher('field2', 'value2'),
        ], $matcher->getFilters());

        self::assertEquals([
            new TermMatcher('field3', 'value3'),
            new TermMatcher('field4', 'value4'),
        ], $matcher->getMusts());

        self::assertEquals([
            new TermMatcher('field5', 'value5'),
            new TermMatcher('field6', 'value6'),
        ], $matcher->getMustNots());

        self::assertEquals([
            new TermMatcher('field7', 'value7'),
            new TermMatcher('field8', 'value8'),
        ], $matcher->getShoulds());

        self::assertEquals(1, $matcher->getMinimumShouldMatch());
    }
}
