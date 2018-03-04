<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-query-string-query.html
 * @see QueryStringMatcherTest
 *
 * @options 'fields' => ?,
 *          'default_field' => '_all', '?',
 *          'default_operator' => 'AND', 'OR',
 *          'analyzer' => 'standard', '?',
 *          'allow_leading_wildcard' => true,
 *          'enable_position_increments' => true,
 *          'fuzzy_max_expansions' => false,
 *          'fuzziness' => 3, 'AUTO',
 *          'fuzzy_prefix_length' => 0,
 *          'phrase_slop' => 5,
 *          'boost' => 1.0,
 *          'auto_generate_phrase_queries' => false,
 *          'analyze_wildcard' => true,
 *          'max_determinized_states' => 10000,
 *          'minimum_should_match' => 2, -2, '75%', '-25%', '3<90%', '2<-25%', '9<-3',
 *          'lenient' => true,
 *          'time_zone' => '?',
 *          'quote_field_suffix' => ?,
 *          'split_on_whitespace' => true,
 *          'all_fields' => false,
 *          'use_dis_max' => true,
 *          'tie_breaker' => 0.3,
 *          '_name' => '?',
 */
class QueryStringMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $query;

    public function __construct(string $query, array $options = [])
    {
        $this->query = $query;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['query'] = $this->query;
        $body += $this->options;

        return [
            'query_string' => $body,
        ];
    }
}
