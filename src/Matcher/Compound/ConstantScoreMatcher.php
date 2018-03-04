<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-constant-score-query.html
 * @see ConstantScoreMatcherTest
 *
 * @options '_name' => '?',
 */
class ConstantScoreMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var MatcherInterface */
    protected $filter;

    /** @var float */
    protected $boost;

    public function __construct(MatcherInterface $filter, float $boost, array $options = [])
    {
        $this->filter = $filter;
        $this->boost = $boost;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [
            'filter' => $this->filter->jsonSerialize(),
            'boost' => $this->boost,
        ];
        $body += $this->options;

        return [
            'constant_score' => $body,
        ];
    }
}
