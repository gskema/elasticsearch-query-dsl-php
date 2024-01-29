<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Span;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;
use InvalidArgumentException;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-span-or-query.html
 * @see SpanOrMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class SpanOrMatcher implements SpanMatcherInterface
{
    use HasOptionsTrait;

    public function __construct(
        /** @var SpanMatcherInterface[] */
        protected array $spanMatchers,
    ) {
        if (empty($spanMatchers)) {
            throw new InvalidArgumentException('Expected at least one span matcher, got none');
        }
    }

    public function __clone()
    {
        $this->spanMatchers = array_clone($this->spanMatchers);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['clauses'] = obj_array_json_serialize($this->spanMatchers);
        $body += $this->options;

        return [
            'span_or' => $body,
        ];
    }
}
