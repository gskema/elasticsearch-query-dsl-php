<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

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
