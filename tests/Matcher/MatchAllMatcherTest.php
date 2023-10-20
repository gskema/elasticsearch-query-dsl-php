<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class MatchAllMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "match_all": {}
            }',
            new MatchAllMatcher(),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "match_all": {
                    "boost": 1.0
                }
            }',
            new MatchAllMatcher(['boost' => 1.0]),
        ];
        return $dataSets;
    }
}
