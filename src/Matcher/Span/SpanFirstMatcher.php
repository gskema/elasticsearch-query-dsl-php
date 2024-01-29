<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Span;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-span-first-query.html
 * @see SpanFirstMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class SpanFirstMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected SpanMatcherInterface $matcher,
        protected int $end,
    ) {
    }

    public function __clone()
    {
        $this->matcher = clone $this->matcher;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [
            'match' => $this->matcher->jsonSerialize(),
            'end' => $this->end,
        ];
        $body += $this->options;

        return [
            'span_first' => $body,
        ];
    }
}
