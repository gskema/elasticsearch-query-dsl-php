<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-mlt-query.html
 * @see MoreLikeThisMatcherTest
 *
 * @options 'unlike' => ?,
 *          'like_text' => ?,
 *          'ids' => ['id1', 'id2'],
 *          'docs' => ?,
 *          'max_query_terms' => 2,
 *          'min_term_freq' => 5,
 *          'max_doc_freq' => 0,
 *          'min_word_length' => 0,
 *          'max_word_length' => 0,
 *          'stop_words' => ['word1', 'word2'],
 *          'analyzer' => 'standard',
 *          'minimum_should_match' => ?,
 *          'boost_terms' => 0,
 *          'include' => false,
 *          'boost' => 1.0,
 *          '_name' => '?',
 */
class MoreLikeThisMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var array */
    protected $fields;

    /** @var array|string */
    protected $like;

    public function __construct(array $fields, $like, array $options = [])
    {
        $this->fields = $fields;
        $this->like = $like;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [
            'fields' => $this->fields,
            'like' => $this->like,
        ];
        $body += $this->options;

        return [
            'more_like_this' => $body,
        ];
    }
}
