<?php

namespace Gskema\ElasticSearchQueryDSL\Highlighter;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;
use stdClass;

use function Gskema\ElasticSearchQueryDSL\array_clone;

/**
 * Options can be global or on overridden on field level.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-highlighting.html
 * @see HighlighterTest
 */
#[Options([
    'boundary_chars' => '.,!? \\t\\n',
    'boundary_max_scan' => 20,
    'boundary_scanner' => 'chars', // 'sentence', 'word',
    'boundary_scanner_locale' => '?',
    'encoder' => 'default', // 'html',
    'force_source' => true,
    'fragmenter' => 'simple', // 'span',
    'fragment_offset' => 10,
    'fragment_size' => 150,
    'highlight_query' => MatcherInterface::class,
    'matched_fields' => ['content', 'content.plain'],
    'no_match_size' => 150,
    'number_of_fragments' => 3,
    'order' => 'score',
    'phrase_limit' => 256,
    'pre_tags' => ['<tag1>', '<tag2>'],
    'post_tags' => ['</tag1>', '</tag2>'],
    'require_field_match' => false,
    'tags_schema' => 'styled',
    'type' => 'plain', // 'fvh', 'unified',
])]
class Highlighter implements HighlighterInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        /** @var array<string, mixed[]> */
        protected array $optionsByField = [],
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->optionsByField = array_clone($this->optionsByField);
        $this->options = array_clone($this->options);
    }

    /**
     * @param array<string, mixed> $options
     */
    public function setField(string $field, array $options = []): static
    {
        $this->optionsByField[$field] = $options;
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = $this->options;
        $query = $body['highlight_query'] ?? null;
        if ($query instanceof MatcherInterface) {
            $body['highlight_query'] = $query->jsonSerialize();
        }

        foreach ($this->optionsByField as $field => $options) {
            $body['fields'][$field] = $options ?: new stdClass();
            $query = $options['highlight_query'] ?? null;
            if ($query instanceof MatcherInterface) {
                $body['fields'][$field]['highlight_query'] = $query->jsonSerialize();
            }
        }

        return $body;
    }
}
