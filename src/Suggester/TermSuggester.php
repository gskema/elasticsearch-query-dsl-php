<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-suggesters-term.html
 * @see TermSuggesterTest
 */
#[Options([
    'analyzer' => 'standard',
    'size' => 5,
    'sort' => 'score', // 'frequency',
    'suggest_mode' => 'missing', // 'popular', 'always',
    'lowercase_terms' => true,
    'max_edits' => 2,
    'prefix_length' => 1,
    'min_word_length' => 4,
    'shard_size' => 5,
    'max_inspections' => 5,
    'min_doc_freq' => 0,
    'max_term_freq' => 0.01,
    'string_distance' => 'internal', // 'damerau_levenshtein', 'levenstein', 'jarowinkler', 'ngram',
])]
class TermSuggester implements SuggesterInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        protected string $text,
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
        $body['text'] = $this->text;
        $body['term']['field'] = $this->field;
        $body['term'] += $this->options;

        return $body;
    }
}
