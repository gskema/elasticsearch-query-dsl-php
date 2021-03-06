<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-parent-id-query.html
 * @see ParentIdMatcherTest
 *
 * @options 'ignore_unmapped' => true,
 *          '_name' => '?',
 */
class ParentIdMatcher implements MatcherInterface
{
    use HasOptionsTrait;
    use HasInnerHitsTrait;

    /** @var string */
    protected $childType;

    /** @var string|int */
    protected $parentId;

    public function __construct(string $childType, string $parentId, array $options = [])
    {
        $this->childType = $childType;
        $this->parentId = $parentId;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->innerHits = $this->innerHits ? clone $this->innerHits : null;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [
            'type' => $this->childType,
            'id' => $this->parentId,
        ];
        $body += $this->options;

        if ($this->hasInnerHits()) {
            $body['inner_hits'] = $this->innerHits->jsonSerialize();
        }

        return [
            'parent_id' => $body,
        ];
    }
}
