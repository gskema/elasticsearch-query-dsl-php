<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see LookupTermsMatcher
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-terms-query.html
 * @see TermsMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class TermsMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        /** @var string[]|float[]|int[]|bool[]|null[] */
        protected array $values,
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
        $body[$this->field] = $this->values;
        $body += $this->options;

        return [
            'terms' => $body,
        ];
    }
}
