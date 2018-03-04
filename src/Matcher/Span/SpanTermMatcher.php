<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-span-term-query.html
 * @see SpanTermMatcherTest
 *
 * @options 'boost' => 1.0,
 *          '_name' => '?',
 */
class SpanTermMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string */
    protected $value;

    public function __construct(string $field, string $value, array $options = [])
    {
        $this->field = $field;
        $this->value = $value;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
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
