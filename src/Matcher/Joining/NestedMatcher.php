<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-nested-query.html
 * @see NestedMatcherTest
 *
 * @options 'score_mode' => 'min', 'max', 'sum', 'avg', 'none',
 *          'ignore_unmapped' => true,
 *          '_name' => '?',
 */
class NestedMatcher implements MatcherInterface
{
    use HasOptionsTrait;
    use HasInnerHitsTrait;

    /** @var string */
    protected $path;

    /** @var MatcherInterface */
    protected $query;

    public function __construct(string $path, MatcherInterface $query, array $options = [])
    {
        $this->path = $path;
        $this->query = $query;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->query = clone $this->query;
        $this->innerHits = $this->innerHits ? clone $this->innerHits: null;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['path'] = $this->path;
        $body += $this->options;
        $body['query'] = $this->query;

        if ($this->hasInnerHits()) {
            $body['inner_hits'] = $this->innerHits->jsonSerialize();
        }

        return [
            'nested' => $body
        ];
    }
}
