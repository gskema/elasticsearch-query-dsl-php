<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MultiTermMatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-range-query.html
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/range.html
 * @see RangeMatcherTest
 */
#[Options([
    'boost' => 2.0,
    'format' => 'dd/MM/yyyy||yyyy',
    'time_zone' => '+01:00',
    'relation' => 'WITHIN', // 'INTERSECTS', 'CONTAINS',
    '_name' => '?',
])]
class RangeMatcher implements MultiTermMatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        /** @var array<string, mixed> ['gt' => 5, 'gte' => 5, 'lt' => 5, 'lte' => 5] */
        protected array $range,
        array $options = [],
    ) {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = $this->range;
        $body += $this->options;

        return [
            'range' => [
                $this->field => $body,
            ],
        ];
    }
}
