<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-exists-query.html
 * @see ExistsMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class ExistsMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected string $field,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['field'] = $this->field;
        $body += $this->options;

        return [
            'exists' => $body,
        ];
    }
}
