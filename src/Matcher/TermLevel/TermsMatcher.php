<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

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
