<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-multi-match-query.html
 * @see MultiMatchMatcherTest
 */
#[Options([
    'type' => 'best_fields', // 'most_fields', 'cross_fields', 'phrase', 'phrase_prefix',
    'tie_breaker' => 0.3,
    'operator' => 'and', // 'or',
    'minimum_should_match' => '1',
    'analyzer' => 'standard',
    'lenient' => true,
    'slop' => 2,
    'fuzziness' => 2, // 'AUTO',
    'prefix_length' => 5,
    'max_expansions' => 5,
    'fuzzy_rewrite' => "constant_score",
    'fuzzy_transpositions' => false,
    'zero_terms_query' => 'all', // 'none',
    'cutoff_frequency' => 0.01,
    'boost' => 2,
    '_name' => '?',
])]
class MultiMatchMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        /** @var string[] */
        protected array $fields,
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
