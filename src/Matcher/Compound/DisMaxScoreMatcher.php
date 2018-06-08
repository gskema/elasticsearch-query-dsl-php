<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use InvalidArgumentException;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-dis-max-query.html
 * @see DisMaxScoreMatcherTest
 *
 * @options 'boost' => 1.0,
 *          'tie_breaker' => 0.0,
 *          '_name' => '?',
 */
class DisMaxScoreMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var MatcherInterface[] */
    protected $queries;

    /**
     * @param MatcherInterface[] $queries
     * @param array              $options
     */
    public function __construct(array $queries, array $options = [])
    {
        if (empty($queries)) {
            throw new InvalidArgumentException('Expected at least one query, got none');
        }
        $this->queries = $queries;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->queries = array_clone($this->queries);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['queries'] = array_map(function (MatcherInterface $query) {
            return $query->jsonSerialize();
        }, $this->queries);
        $body += $this->options;

        return [
            'dis_max' => $body,
        ];
    }
}
