<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-indices-query.html
 * @see IndicesMatcherTest
 *
 * @options '_name' => '?',
 */
class IndicesMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string[] */
    protected $indices;

    /** @var MatcherInterface */
    protected $query;

    /** @var MatcherInterface */
    protected $noMatchQuery;

    public function __construct(array $indices, MatcherInterface $query, MatcherInterface $noMatchQuery)
    {
        $this->indices = $indices;
        $this->query = $query;
        $this->noMatchQuery = $noMatchQuery;
    }

    public function __clone()
    {
        $this->query = clone $this->query;
        $this->noMatchQuery = clone $this->noMatchQuery;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [
            'indices' => $this->indices,
            'query' => $this->query->jsonSerialize(),
            'no_match_query' => $this->noMatchQuery->jsonSerialize(),
        ];
        $body += $this->options;

        return [
            'indices' => $body,
        ];
    }
}
