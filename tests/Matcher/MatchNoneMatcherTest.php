<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class MatchNoneMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "match_none": {}
            }',
            new MatchNoneMatcher(),
        ];

        return $dataSets;
    }
}
