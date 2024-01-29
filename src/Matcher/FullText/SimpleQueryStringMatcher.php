<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\FullText;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-simple-query-string-query.html
 * @see SimpleQueryStringMatcherTest
 */
#[Options([
    'fields' => ['body^5', '_all'],
    'default_operator' => 'AND', // 'OR',
    'analyzer' => 'standard',
    'flags' => 'ALL|NONE|AND|OR|NOT|PREFIX|PHRASE|PRECEDENCE|ESCAPE|WHITESPACE|FUZZY|NEAR|SLOP',
    'analyze_wildcard' => true,
    'lenient' => true,
    'minimum_should_match' => 5,
    'quote_field_suffix' => '.exact',
    'auto_generate_synonyms_phrase_query' => false,
    'fuzzy_prefix_length' => 0,
    'fuzzy_max_expansions' => 50,
    'fuzzy_transpositions' => true,
    '_name' => '?',
])]
class SimpleQueryStringMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $query,
        array $options = [],
    ) {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['query'] = $this->query;
        $body += $this->options;

        return [
            'simple_query_string' => $body,
        ];
    }
}
