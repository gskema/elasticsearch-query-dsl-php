<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-mlt-query.html
 * @see MoreLikeThisMatcherTest
 */
#[Options([
    'unlike' => '?',
    'max_query_terms' => 2,
    'min_term_freq' => 5,
    'min_doc_freq' => 5,
    'max_doc_freq' => 0,
    'min_word_length' => 0,
    'max_word_length' => 0,
    'stop_words' => ['word1', 'word2'],
    'analyzer' => 'standard',
    'minimum_should_match' => '?',
    'fail_on_unsupported_field' => true,
    'boost_terms' => 0,
    'include' => false,
    'boost' => 1.0,
    '_name' => '?',
])]
class MoreLikeThisMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        /** @var string[] */
        protected array $fields,
        /** @var mixed[]|string */
        protected array|string $like,
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
            'fields' => $this->fields,
            'like' => $this->like,
        ];
        $body += $this->options;

        return [
            'more_like_this' => $body,
        ];
    }
}
