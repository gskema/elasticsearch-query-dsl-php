<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;

final class NotMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "bool": {
                    "must_not": {
                        "match_all": {}
                    }
                }
             }',
            new NotMatcher(new MatchAllMatcher()),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new NotMatcher(new MatchAllMatcher());
        self::assertInstanceOf(NotMatcher::class, $matcher1);
    }
}
