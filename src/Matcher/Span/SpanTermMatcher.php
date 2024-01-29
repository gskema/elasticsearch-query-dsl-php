<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Span;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-span-term-query.html
 * @see SpanTermMatcherTest
 */
#[Options([
    'boost' => 1.0,
    '_name' => '?',
])]
class SpanTermMatcher implements SpanMatcherInterface
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
        $body = [];
        if (!empty($this->options)) {
            $body[$this->field]['value'] = $this->value;
            $body[$this->field] += $this->options;
        } else {
            $body[$this->field] = $this->value;
        }

        return [
            'span_term' => $body,
        ];
    }
}
