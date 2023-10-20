<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Options;
use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-match-all-query.html
 * @see MatchAllMatcherTest
 */
#[Options([
    'boost' => 1.0,
    '_name' => '?',
])]
class MatchAllMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'match_all' => $this->options ?: new stdClass(),
        ];
    }
}
