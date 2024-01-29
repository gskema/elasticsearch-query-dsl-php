<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Span;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-span-not-query.html
 * @see SpanNotMatcherTest
 */
#[Options([
    'pre' => 1,
    'post' => 2,
    'dist' => 2,
    '_name' => '?',
])]
class SpanNotMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected SpanMatcherInterface $include,
        protected SpanMatcherInterface $exclude,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->include = clone $this->include;
        $this->exclude = clone $this->exclude;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [
            'include' => $this->include->jsonSerialize(),
            'exclude' => $this->exclude->jsonSerialize(),
        ];
        $body += $this->options;

        return [
            'span_not' => $body,
        ];
    }
}
