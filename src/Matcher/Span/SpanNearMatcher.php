<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use InvalidArgumentException;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-span-near-query.html
 * @see SpanNearMatcherTest
 *
 * @options '_name' => '?',
 */
class SpanNearMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    /** @var SpanMatcherInterface[] */
    protected $spanMatchers;

    /** @var int */
    protected $slop;

    /** @var bool */
    protected $inOrder;

    /**
     * @param SpanMatcherInterface[] $spanMatchers
     * @param int                    $slop
     * @param bool                   $inOrder
     */
    public function __construct(array $spanMatchers, int $slop, bool $inOrder)
    {
        if (empty($spanMatchers)) {
            throw new InvalidArgumentException('Expected at least one span matcher, got none');
        }
        $this->spanMatchers = $spanMatchers;
        $this->slop = $slop;
        $this->inOrder = $inOrder;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [
            'clauses' => array_map(function (SpanMatcherInterface $matcher) {
                return $matcher->jsonSerialize();
            }, $this->spanMatchers),
            'slop' => $this->slop,
            'in_order' => $this->inOrder,
        ];
        $body += $this->options;

        return [
            'span_near' => $body,
        ];
    }
}
