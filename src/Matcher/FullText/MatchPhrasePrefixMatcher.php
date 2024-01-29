<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\FullText;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-match-query-phrase-prefix.html
 * @see MatchPhrasePrefixMatcherTest
 */
#[Options([
    'slop' => 2,
    'analyzer' => 'standard',
    'max_expansions' => 50,
    '_name' => '?',
])]
class MatchPhrasePrefixMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        protected string $query,
        array $options = [],
    ) {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['query'] = $this->query;
        $body += $this->options;

        return [
            'match_phrase_prefix' => [
                $this->field => $body,
            ],
        ];
    }
}
