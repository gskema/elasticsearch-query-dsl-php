<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-suggesters-term.html
 * @see TermSuggesterTest
 *
 * @options 'analyzer' => 'standard',
 *          'size' => 5,
 *          'sort' => 'score', 'frequency',
 *          'suggest_mode' => 'missing', 'popular', 'always',
 *          'lowercase_terms' => true,
 *          'max_edits' => 2,
 *          'prefix_length' => 1,
 *          'min_word_length' => 4,
 *          'shard_size' => 5,
 *          'max_inspections' => 5,
 *          'min_doc_freq' => 0,
 *          'max_term_freq' => 0.01,
 *          'string_distance' => 'internal', 'damerau_levenshtein', 'levenstein', 'jarowinkler', 'ngram',
 */
class TermSuggester implements SuggesterInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string */
    protected $text;

    public function __construct(string $field, string $text, array $options = [])
    {
        $this->field = $field;
        $this->text = $text;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body['text'] = $this->text;
        $body['term']['field'] = $this->field;
        $body['term'] += $this->options;

        return $body;
    }
}
