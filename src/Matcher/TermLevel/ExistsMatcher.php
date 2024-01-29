<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

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
