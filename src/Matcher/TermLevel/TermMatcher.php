<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-term-query.html
 * @see TermMatcherTest
 */
#[Options([
    'boost' => 1.0,
    '_name' => '?',
])]
class TermMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        protected string|float|int|bool|null $value,
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
            $body['value'] = $this->value;
            $body += $this->options;
        } else {
            $body = $this->value;
        }

        return [
            'term' => [
                $this->field => $body,
            ],
        ];
    }
}
