<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher;

use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-match-all-query.html#query-dsl-match-none-query
 * @see MatchNoneMatcherTest
 */
class MatchNoneMatcher implements MatcherInterface
{
    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'match_none' => new stdClass(),
        ];
    }
}
