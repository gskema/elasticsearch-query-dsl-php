<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-simple-query-string-query.html
 * @see SimpleQueryStringMatcherTest
 *
 * @options 'fields' => ['body^5', '_all'],
 *          'default_operator' => 'AND','OR',
 *          'analyzer' => 'standard',
 *          'flags' => 'ALL|NONE|AND|OR|NOT|PREFIX|PHRASE|PRECEDENCE|ESCAPE|WHITESPACE|FUZZY|NEAR|SLOP'
 *          'analyze_wildcard' => true,
 *          'lenient' => true,
 *          'minimum_should_match' => 5,
 *          'quote_field_suffix' => '.exact',
 *          'all_fields' => true,
 *          '_name' => '?',
 */
class SimpleQueryStringMatcher implements MatcherInterface
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
        $body['query'] = $this->query;
        $body += $this->options;

        return [
            'simple_query_string' => $body,
        ];
    }
}
