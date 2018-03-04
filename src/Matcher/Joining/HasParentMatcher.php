<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-has-parent-query.html
 * @see HasParentMatcherTest
 *
 * @options 'score' => true,
 *          'ignore_unmapped' => true,
 *          '_name' => '?',
 */
class HasParentMatcher implements MatcherInterface
{
    use HasOptionsTrait;
    use HasInnerHitsTrait;

    /** @var string */
    protected $parentType;

    /** @var MatcherInterface */
    protected $query;

    public function __construct(string $parentType, MatcherInterface $query, array $options = [])
    {
        $this->parentType = $parentType;
        $this->query = $query;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['parent_type'] = $this->parentType;
        $body += $this->options;
        $body['query'] = $this->query;

        if ($this->hasInnerHits()) {
            $body['inner_hits'] = $this->innerHits->jsonSerialize();
        }

        return [
            'has_parent' => $body,
        ];
    }
}
