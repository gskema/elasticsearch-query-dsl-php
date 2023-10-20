<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MultiTermMatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-span-multi-term-query.html
 * @see SpanMultiMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class SpanMultiMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected MultiTermMatcherInterface $matcher,
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
        $body = [];
        $body['match'] = $this->matcher->jsonSerialize();
        $body += $this->options;

        return [
            'span_multi' => $body,
        ];
    }
}
