<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\FullText;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-match-query.html
 * @see MatchMatcherTest
 */
#[Options([
    'operator' => 'and', // 'or',
    'minimum_should_match' => '?',
    'analyzer' => 'standard',
    'lenient' => true,
    'fuzziness' => 2, // 'AUTO',
    'prefix_length' => 5,
    'max_expansions' => 5,
    'fuzzy_rewrite' => 10,
    'fuzzy_transpositions' => false,
    'zero_terms_query' => 'all', // 'none',
    'cutoff_frequency' => 0.01,
    'auto_generate_synonyms_phrase_query' => true,
    '_name' => '?',
])]
class MatchMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
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
            'match' => [
                $this->field => $body,
            ],
        ];
    }
}
