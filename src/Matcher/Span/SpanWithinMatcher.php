<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-span-within-query.html
 * @see SpanWithinMatcherTest
 *
 * @options '_name' => '?',
 */
class SpanWithinMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    /** @var SpanMatcherInterface */
    protected $little;

    /** @var SpanMatcherInterface */
    protected $big;

    public function __construct(SpanMatcherInterface $little, SpanMatcherInterface $big)
    {
        $this->little = $little;
        $this->big = $big;
    }

    public function __clone()
    {
        $this->little = clone $this->little;
        $this->big = clone $this->big;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
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
