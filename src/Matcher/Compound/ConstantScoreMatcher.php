<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Compound;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-constant-score-query.html
 * @see ConstantScoreMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class ConstantScoreMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected MatcherInterface $filter,
        protected float $boost,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->filter = clone $this->filter;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [
            'filter' => $this->filter->jsonSerialize(),
            'boost' => $this->boost,
        ];
        $body += $this->options;

        return [
            'constant_score' => $body,
        ];
    }
}
