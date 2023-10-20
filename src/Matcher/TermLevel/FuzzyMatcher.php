<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MultiTermMatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-fuzzy-query.html
 * @see FuzzyMatcherTest
 */
#[Options([
    'boost' => 2.0,
    'fuzziness' => 'AUTO', // 5,
    'prefix_length' => 0,
    'max_expansions' => 50,
    'transpositions' => false,
    '_name' => '?',
])]
class FuzzyMatcher implements MultiTermMatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        protected string $value,
        array $options = [],
    ) {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        if (!empty($this->options)) {
            $body = [];
            $body['value'] = $this->value;
            $body += $this->options;
        } else {
            $body = $this->value;
        }

        return [
            'fuzzy' => [
                $this->field => $body,
            ],
        ];
    }
}
