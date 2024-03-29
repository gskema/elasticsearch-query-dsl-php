<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Compound;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;
use InvalidArgumentException;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-dis-max-query.html
 * @see DisMaxScoreMatcherTest
 */
#[Options([
    'boost' => 1.0,
    'tie_breaker' => 0.0,
    '_name' => '?',
])]
class DisMaxScoreMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        /** @var MatcherInterface[] */
        protected array $queries,
        array $options = [],
    ) {
        if (empty($queries)) {
            throw new InvalidArgumentException('Expected at least one query, got none');
        }
        $this->options = $options;
    }

    public function __clone()
    {
        $this->queries = array_clone($this->queries);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['queries'] = obj_array_json_serialize($this->queries);
        $body += $this->options;

        return [
            'dis_max' => $body,
        ];
    }
}
