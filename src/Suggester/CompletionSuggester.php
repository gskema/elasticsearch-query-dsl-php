<?php

namespace Gskema\ElasticsearchQueryDSL\Suggester;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;
use InvalidArgumentException;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-suggesters-completion.html
 * @see CompletionSuggesterTest
 */
#[Options([
    'size' => 5,
    'fuzzy' => [
        'fuzziness' => '?',
        'transpositions' => true,
        'min_length' => 3,
        'prefix_length' => 1,
        'unicode_aware' => false
    ],
    'flags' => 'ANYSTRING',// 'COMPLEMENT', 'EMPTY', 'INTERSECTION', 'INTERVAL', 'NONE',
    'max_determinized_states' => 10000,
    'skip_duplicates' => true,
])]
class CompletionSuggester implements SuggesterInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    protected function __construct(
        protected string $field,
        protected ?string $prefix,
        protected ?string $regex,
        array $options = [],
    ) {
        if (null === $prefix && null === $regex) {
            throw new InvalidArgumentException('Expected at least one to be not null: prefix of regex.');
        }
        $this->options = $options;
    }

    /**
     * @param array<string, mixed> $options
     */
    public static function fromPrefix(string $field, string $prefix, array $options = []): static
    {
        return new static($field, $prefix, null, $options);
    }

    /**
     * @param array<string, mixed> $options
     */
    public static function fromRegex(string $field, string $regex, array $options = []): static
    {
        return new static($field, null, $regex, $options);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        if (null !== $this->prefix) {
            $body['prefix'] = $this->prefix;
        }
        if (null !== $this->regex) {
            $body['regex'] = $this->regex;
        }
        $body['completion']['field'] = $this->field;
        $body['completion'] += $this->options;

        return $body;
    }
}
