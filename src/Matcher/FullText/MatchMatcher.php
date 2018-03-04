<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-match-query.html
 * @see MatchMatcherTest
 *
 * @options 'operator' => 'and', 'or',
 *          'minimum_should_match' => ?,
 *          'analyzer' => 'standard',
 *          'lenient' => true,
 *          'fuzziness' => 2, 'AUTO',
 *          'prefix_length' => 5,
 *          'max_expansions' => 5,
 *          'fuzzy_rewrite' => 10,
 *          'fuzzy_transpositions' => false,
 *          'zero_terms_query' => 'all', 'none',
 *          'cutoff_frequency' => 0.01,
 *          '_name' => '?',
 */
class MatchMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string */
    protected $query;

    public function __construct(string $field, string $query, array $options = [])
    {
        $this->field = $field;
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
            'match' => [
                $this->field => $body,
            ],
        ];
    }
}
