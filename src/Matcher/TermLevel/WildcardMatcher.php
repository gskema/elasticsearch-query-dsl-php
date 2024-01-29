<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MultiTermMatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-wildcard-query.html
 * @see WildcardMatcherTest
 */
#[Options([
    'boost' => 1.0,
    '_name' => '?',
    'rewrite' => 'constant_score', // 'scoring_boolean', 'constant_score_boolean', 'top_terms_N',
                                   // 'top_terms_boost_N', 'top_terms_blended_freqs_N',
])]
class WildcardMatcher implements MultiTermMatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        protected string $value,
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
            'wildcard' => [
                $this->field => $body,
            ],
        ];
    }
}
