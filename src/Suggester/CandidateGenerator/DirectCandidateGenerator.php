<?php

namespace Gskema\ElasticsearchQueryDSL\Suggester\CandidateGenerator;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-suggesters-phrase.html#_direct_generators
 * @see DirectCandidateGeneratorTest
 */
#[Options([
    'size' => 1,
    'suggest_mode' => 'missing', // 'always', 'popular',
    'max_edits' => 2,
    'prefix_length' => 1,
    'min_word_length' => 4,
    'max_inspections' => 5,
    'min_doc_freq' => 0,
    'max_term_freq' => 0.01,
    'pre_filter' => 'reverse',
    'post_filter' => 'reverse',
])]
class DirectCandidateGenerator implements CandidateGeneratorInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
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
        $body['field'] = $this->field;
        $body += $this->options;

        return $body;
    }
}
