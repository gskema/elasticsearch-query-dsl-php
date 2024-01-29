<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MultiTermMatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-regexp-query.html
 * @see RegexpMatcherTest
 */
#[Options([
    'flags' => 'ALL|ANYSTRING|COMPLEMENT|EMPTY|INTERSECTION|INTERVAL|NONE',
    'max_determinized_states' => 2000,
    'boost' => 2,
    '_name' => '?',
])]
class RegexpMatcher implements MultiTermMatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        protected string $regex,
        array $options = [],
    ) {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        if (!empty($this->options)) {
            $body = [];
            $body['value'] = $this->regex;
            $body += $this->options;
        } else {
            $body = $this->regex;
        }

        return [
            'regexp' => [
                $this->field => $body,
            ],
        ];
    }
}
