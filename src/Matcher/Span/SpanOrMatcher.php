<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use InvalidArgumentException;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-span-or-query.html
 * @see SpanOrMatcherTest
 *
 * @options '_name' => '?',
 */
class SpanOrMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    /** @var SpanMatcherInterface[] */
    protected $spanMatchers;

    /**
     * @param SpanMatcherInterface[] $spanMatchers
     */
    public function __construct(array $spanMatchers)
    {
        if (empty($spanMatchers)) {
            throw new InvalidArgumentException('Expected at least one span matcher, got none');
        }
        $this->spanMatchers = $spanMatchers;
    }

    public function __clone()
    {
        $this->spanMatchers = array_clone($this->spanMatchers);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['clauses'] =array_map(function (SpanMatcherInterface $matcher) {
            return $matcher->jsonSerialize();
        }, $this->spanMatchers);
        $body += $this->options;

        return [
            'span_or' => $body,
        ];
    }
}
