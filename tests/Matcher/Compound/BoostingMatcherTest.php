<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\WildcardMatcher;

final class BoostingMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "boosting": {
                    "positive": { "wildcard": { "field1": "value1*" } },
                    "negative": { "term" : { "field1": "value1" } },
                    "negative_boost": 0.5
                }
             }',
            new BoostingMatcher(
                new WildcardMatcher('field1', 'value1*'),
                new TermMatcher('field1', "value1"),
                0.5
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new BoostingMatcher(
            new WildcardMatcher('field1', 'value1*'),
            new TermMatcher('field1', "value1"),
            0.5
        );
        self::assertInstanceOf(BoostingMatcher::class, $matcher1);
    }
}
