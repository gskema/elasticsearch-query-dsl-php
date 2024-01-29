<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher;

use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-match-all-query.html#query-dsl-match-none-query
 * @see MatchNoneMatcherTest
 */
class MatchNoneMatcher implements MatcherInterface
{
    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'match_none' => new stdClass(),
        ];
    }
}
