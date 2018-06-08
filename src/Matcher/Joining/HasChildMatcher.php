<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-has-child-query.html
 * @see HasChildMatcherTest
 *
 * @options 'score_mode' => 'min', 'max', 'sum', 'avg', 'none',
 *          'min_children' => 2,
 *          'max_children' => 10,
 *          'min_children' => true,
 *          'ignore_unmapped' => true,
 *          '_name' => '?',
 */
class HasChildMatcher implements MatcherInterface
{
    use HasOptionsTrait;
    use HasInnerHitsTrait;

    /** @var string */
    protected $childType;

    /** @var MatcherInterface */
    protected $query;

    public function __construct(string $childType, MatcherInterface $query, array $options = [])
    {
        $this->childType = $childType;
        $this->query = $query;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->query = clone $this->query;
        $this->innerHits = $this->innerHits ? clone $this->innerHits : null;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['type'] = $this->childType;
        $body['query'] = $this->query->jsonSerialize();
        $body += $this->options;

        if ($this->hasInnerHits()) {
            $body['inner_hits'] = $this->innerHits->jsonSerialize();
        }

        return [
            'has_child' => $body,
        ];
    }
}
