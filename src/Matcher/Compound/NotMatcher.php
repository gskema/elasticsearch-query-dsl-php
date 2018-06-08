<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-bool-query.html
 * @see NotMatcherTest
 *
 * @options '_name' => '?',
 */
class NotMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var MatcherInterface */
    protected $matcher;

    public function __construct(MatcherInterface $matcher)
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
        $body['must_not'] = $this->matcher->jsonSerialize();
        $body += $this->options;

        return [
            'bool' => $body,
        ];
    }
}
