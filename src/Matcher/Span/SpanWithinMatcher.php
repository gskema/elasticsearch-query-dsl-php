<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-span-within-query.html
 * @see SpanWithinMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class SpanWithinMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected SpanMatcherInterface $little,
        protected SpanMatcherInterface $big,
    ) {
    }

    public function __clone()
    {
        $this->little = clone $this->little;
        $this->big = clone $this->big;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [
            'little' => $this->little->jsonSerialize(),
            'big' => $this->big->jsonSerialize(),
        ];
        $body += $this->options;

        return [
            'span_within' => $body,
        ];
    }
}
