<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-wrapper-query.html
 * @see WrapperMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class WrapperMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $queryString,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['query'] = $this->queryString;
        $body += $this->options;

        return ['wrapper' => $body];
    }
}
