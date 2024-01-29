<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Span;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-span-field-masking-query.html
 * @see SpanFieldMaskingMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class SpanFieldMaskingMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected string $field,
        protected SpanMatcherInterface $matcher,
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
            'query' => $this->matcher->jsonSerialize(),
            'field' => $this->field,
        ];
        $body += $this->options;

        return [
            'field_masking_span' => $body,
        ];
    }
}
