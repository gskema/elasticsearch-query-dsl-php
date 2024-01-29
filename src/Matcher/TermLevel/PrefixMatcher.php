<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MultiTermMatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-prefix-query.html
 * @see PrefixMatcherTest
 */
#[Options([
    'boost' => 1.0,
    '_name' => '?',
])]
class PrefixMatcher implements MultiTermMatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        protected string $prefix,
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
            $body['value'] = $this->prefix;
            $body += $this->options;
        } else {
            $body = $this->prefix;
        }

        return [
            'prefix' => [
                $this->field => $body,
            ],
        ];
    }
}
