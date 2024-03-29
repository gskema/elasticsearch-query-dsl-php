<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\FullText;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-match-query-phrase.html
 * @see MatchPhraseMatcherTest
 */
#[Options([
    'slop' => 2,
    'analyzer' => 'standard',
    'zero_terms_query' => 'all',
    '_name' => '?',
])]
class MatchPhraseMatcher implements MatcherInterface
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
            'match_phrase' => [
                $this->field => $body,
            ],
        ];
    }
}
