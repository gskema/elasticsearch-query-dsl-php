<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Compound;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-bool-query.html
 * @see NotMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class NotMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected MatcherInterface $matcher,
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
        $body = [];
        $body['must_not'] = $this->matcher->jsonSerialize();
        $body += $this->options;

        return [
            'bool' => $body,
        ];
    }
}
