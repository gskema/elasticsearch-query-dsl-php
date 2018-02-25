<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-span-first-query.html
 * @see SpanFirstMatcherTest
 *
 * @options '_name' => '?',
 */
class SpanFirstMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    /** @var SpanMatcherInterface */
    protected $matcher;

    /** @var int */
    protected $end;

    public function __construct(SpanMatcherInterface $matcher, int $end)
    {
        $this->matcher = $matcher;
        $this->end = $end;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
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
