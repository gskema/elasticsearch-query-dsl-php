<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Compound;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Matcher\MatchAllMatcher;

final class ConstantScoreMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "constant_score": {
                    "filter": { "match_all": {} },
                    "boost": 5
                }
            }',
            new ConstantScoreMatcher(
                new MatchAllMatcher(),
                5
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new ConstantScoreMatcher(
            new MatchAllMatcher(),
            5
        );
        self::assertInstanceOf(ConstantScoreMatcher::class, $matcher1);
    }
}
