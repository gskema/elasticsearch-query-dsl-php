<?php

namespace Gskema\ElasticSearchQueryDSL\Highlighter;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use stdClass;

/**
 * Options can be global or on overridden on field level.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-highlighting.html
 * @see HighlighterTest
 *
 * @options 'type' => 'plain', 'fvh', 'postings',
 *          'force_source' => true,
 *          'pre_tags' => ['<tag1>', '<tag2>'],
 *          'post_tags' => ['</tag1>', '</tag2>'],
 *          'tags_schema' => 'styled',
 *          'encoder' => 'default', 'html',
 *          'order' => score,
 *          'fragment_size' => 150,
 *          'number_of_fragments' => 3,
 *          'fragment_offset' => 10,
 *          'no_match_size' => 150,
 *          'fragmenter' => 'simple', 'span',
 *          'highlight_query' => MatcherInterface,
 *          'require_field_match' => false,
 *          'boundary_scanner' => 'chars', 'sentence', 'word',
 *          'boundary_chars' => '.,!? \\t\\n',
 *          'boundary_max_scan' => 20,
 *          'boundary_scanner_locale' => '?',
 *          'max_fragment_length' => 20,
 *          'matched_fields' => ['content', 'content.plain'],
 *          'phrase_limit' => 256,
 */
class Highlighter implements HighlighterInterface
{
    use HasOptionsTrait;

    /** @var array[] */
    protected $optionsByField = [];

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @param string $field
     * @param array  $options
     *
     * @return $this
     */
    public function setField(string $field, array $options = []): Highlighter
    {
        $this->optionsByField[$field] = $options;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = $this->options;
        $query = $body['highlight_query'] ?? null;
        if ($query instanceof MatcherInterface) {
            $body['highlight_query'] = $query->jsonSerialize();
        }

        foreach ($this->optionsByField as $field => $options) {
            $query = $body['fields'][$field]['highlight_query'] ?? null;
            if ($query instanceof MatcherInterface) {
                $body['fields'][$field]['highlight_query'] = $query->jsonSerialize();
            }
            $body['fields'][$field] = $options ?: new stdClass();
        }

        return $body;
    }
}
