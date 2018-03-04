<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-suggesters-completion.html
 * @see CompletionSuggesterTest
 *
 * @options 'size' => 5,
 *          'fuzzy' => ['fuzziness' => ?, 'transpositions' => true, 'min_length' => 3, 'prefix_length' => 1, 'unicode_aware' => false],
 *          'flags' => 'ANYSTRING', 'COMPLEMENT', 'EMPTY', 'INTERSECTION', 'INTERVAL', 'NONE',
 *          'max_determinized_states' => 10000,
 */
class CompletionSuggester implements SuggesterInterface
{
    use HasOptionsTrait;

    /** @var array */
    protected $body;

    protected function __construct(array $body, array $options = [])
    {
        $this->body = $body;
        $this->options = $options;
    }

    /**
     * @param string $field
     * @param string $prefix
     * @param array  $options
     *
     * @return static
     */
    public static function fromPrefix(string $field, string $prefix, array $options = [])
    {
        $body = [];
        $body['prefix'] = $prefix;
        $body['completion']['field'] = $field;

        return new static($body, $options);
    }

    /**
     * @param string $field
     * @param string $regex
     * @param array  $options
     *
     * @return static
     */
    public static function fromRegex(string $field, string $regex, array $options = [])
    {
        $body = [];
        $body['regex'] = $regex;
        $body['completion']['field'] = $field;

        return new static($body, $options);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = $this->body;
        $body['completion'] += $this->options;

        return $body;
    }
}
