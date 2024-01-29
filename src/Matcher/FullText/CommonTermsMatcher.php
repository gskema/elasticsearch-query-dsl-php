<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\FullText;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-common-terms-query.html
 * @see CommonTermsMatcherTest
 */
#[Options([
    'minimum_should_match' => '?', // ['low_freq' => 2, 'high_freq' => 3],
    'low_freq_operator' => 'and', // 'or',
    'high_freq_operator' => 'and',// 'or',
    'boost' => 2.0,
    'analyzer' => 'standard',
    '_name' => '?',
])]
class CommonTermsMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        protected string $query,
        protected float $cutoffFrequency,
        array $options = [],
    ) {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [
            'query' => $this->query,
            'cutoff_frequency' => $this->cutoffFrequency,
        ];
        $body += $this->options;

        return [
            'common' => [
                $this->field => $body,
            ]
        ];
    }
}
