<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester\CandidateGenerator;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-suggesters-phrase.html#_direct_generators
 * @see DirectCandidateGeneratorTest
 *
 * @options 'size' => 1,
 *          'suggest_mode' => 'missing', 'always', 'popular',
 *          'max_edits' => 2,
 *          'prefix_length' => 1,
 *          'min_word_length' => 4,
 *          'max_inspections' => 5,
 *          'min_doc_freq' => 0,
 *          'max_term_freq' => 0.01,
 *          'pre_filter' => 'reverse',
 *          'post_filter' => 'reverse',
 *
 */
class DirectCandidateGenerator implements CandidateGeneratorInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    public function __construct(string $field, array $options = [])
    {
        $this->field = $field;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body['field'] = $this->field;
        $body += $this->options;

        return $body;
    }
}
