<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-span-not-query.html
 * @see SpanNotMatcherTest
 *
 * @options 'pre' => 1,
 *          'post' => 2,
 *          'dist' => 2,
 *          '_name' => '?',
 */
class SpanNotMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    /** @var SpanMatcherInterface */
    protected $include;

    /** @var SpanMatcherInterface */
    protected $exclude;

    public function __construct(SpanMatcherInterface $include, SpanMatcherInterface $exclude, array $options = [])
    {
        $this->include = $include;
        $this->exclude = $exclude;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->include = clone $this->include;
        $this->exclude = clone $this->exclude;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
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
