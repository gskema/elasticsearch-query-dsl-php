<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-query-string-query.html
 * @see QueryStringMatcherTest
 */
#[Options([
    'fields' => '?',
    'type' => 'best_fields', // 'most_fields', 'cross_fields', 'phrase', 'phrase_prefix',
    'default_field' => '_all', // '?',
    'default_operator' => 'AND', // 'OR',
    'analyzer' => 'standard', // '?',
    'quote_analyzer' => '?',
    'allow_leading_wildcard' => true,
    'enable_position_increments' => true,
    'fuzzy_max_expansions' => false,
    'fuzziness' => 3, // 'AUTO',
    'fuzzy_prefix_length' => 0,
    'fuzzy_transpositions' => false,
    'phrase_slop' => 5,
    'boost' => 1.0,
    'analyze_wildcard' => true,
    'max_determinized_states' => 10000,
    'minimum_should_match' => 2, // -2, '75%', '-25%', '3<90%', '2<-25%', '9<-3',
    'lenient' => true,
    'time_zone' => '?',
    'quote_field_suffix' => '?',
    'auto_generate_synonyms_phrase_query' => true,
    'tie_breaker' => 0.3,
    '_name' => '?',
])]
class QueryStringMatcher implements MatcherInterface
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
            'query_string' => $body,
        ];
    }
}
