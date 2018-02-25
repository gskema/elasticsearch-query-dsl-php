<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-span-field-masking-query.html
 * @see SpanFieldMaskingMatcherTest
 *
 * @options '_name' => '?',
 */
class SpanFieldMaskingMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var SpanMatcherInterface */
    protected $matcher;

    public function __construct(string $field, SpanMatcherInterface $matcher)
    {
        $this->field = $field;
        $this->matcher = $matcher;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
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
