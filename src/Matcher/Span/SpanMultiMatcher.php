<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MultiTermMatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-span-multi-term-query.html
 * @see SpanMultiMatcherTest
 *
 * @options '_name' => '?',
 */
class SpanMultiMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    /** @var MultiTermMatcherInterface */
    protected $matcher;

    public function __construct(MultiTermMatcherInterface $matcher)
    {
        $this->matcher = $matcher;
    }

    public function __clone()
    {
        $this->matcher = clone $this->matcher;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['match'] = $this->matcher->jsonSerialize();
        $body += $this->options;

        return [
            'span_multi' => $body,
        ];
    }
}
