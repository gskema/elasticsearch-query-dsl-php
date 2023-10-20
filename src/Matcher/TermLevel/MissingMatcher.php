<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-exists-query.html#_literal_missing_literal_query
 * @see MissingMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class MissingMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @param array<string, mixed> $options */
    public function __construct(
        protected string $field,
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
        $body['must_not']['exists']['field'] = $this->field;
        $body += $this->options;

        return [
            'bool' => $body,
        ];
    }
}
