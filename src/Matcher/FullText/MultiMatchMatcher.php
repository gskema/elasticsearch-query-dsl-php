<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-multi-match-query.html
 * @see MultiMatchMatcherTest
 *
 * @options 'type' => 'best_fields', 'most_fields', 'cross_fields', 'phrase', 'phrase_prefix',
 *          'tie_breaker' => 0.3,
 *          'operator' => 'and', 'or',
 *          'minimum_should_match' => '1',
 *          'analyzer' => 'standard',
 *          'lenient' => true,
 *          'slop' => 2,
 *          'fuzziness' => 2, 'AUTO',
 *          'prefix_length' => 5,
 *          'max_expansions' => 5,
 *          'fuzzy_rewrite' => 10,
 *          'fuzzy_transpositions' => false,
 *          'zero_terms_query' => 'all', 'none',
 *          'cutoff_frequency' => 0.01,
 *          '_name' => '?',
 */
class MultiMatchMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string[] */
    protected $fields;

    /** @var string */
    protected $query;

    public function __construct(array $fields, string $query, array $options = [])
    {
        $this->fields = $fields;
        $this->query = $query;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [
            'query' => $this->query,
            'fields' => $this->fields,
        ];
        $body += $this->options;

        return [
            'multi_match' => $body,
        ];
    }
}
