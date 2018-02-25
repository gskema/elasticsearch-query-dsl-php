<?php

namespace Gskema\ElasticSearchQueryDSL\Rescorer;

use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-rescore.html
 * @see QueryRescorerTest
 */
class QueryRescorer implements RescorerInterface
{
    /** @var MatcherInterface */
    protected $query;

    /** @var float|null */
    protected $queryWeight;

    /** @var float|null */
    protected $rescoreQueryWeight;

    /** @var string|null 'total', 'multiply', 'avg', 'max', 'min' */
    protected $scoreMode;

    /** @var int|null */
    protected $windowSize;

    public function __construct(MatcherInterface $query)
    {
        $this->query = $query;
    }

    public function getQuery(): MatcherInterface
    {
        return $this->query;
    }

    /**
     * @return float|null
     */
    public function getQueryWeight()
    {
        return $this->queryWeight;
    }

    /**
     * @param float|null $queryWeight
     *
     * @return $this
     */
    public function setQueryWeight(float $queryWeight): QueryRescorer
    {
        $this->queryWeight = $queryWeight;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getRescoreQueryWeight()
    {
        return $this->rescoreQueryWeight;
    }

    /**
     * @param float|null $rescoreQueryWeight
     *
     * @return $this
     */
    public function setRescoreQueryWeight(float $rescoreQueryWeight): QueryRescorer
    {
        $this->rescoreQueryWeight = $rescoreQueryWeight;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getScoreMode()
    {
        return $this->scoreMode;
    }

    /**
     * @param string|null $scoreMode
     *
     * @return $this
     */
    public function setScoreMode(string $scoreMode = null): QueryRescorer
    {
        $this->scoreMode = $scoreMode;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getWindowSize()
    {
        return $this->windowSize;
    }

    /**
     * @param int|null $windowSize

     * @return $this
     */
    public function setWindowSize(int $windowSize = null): QueryRescorer
    {
        $this->windowSize = $windowSize;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        if (null !== $this->windowSize) {
            $body['window_size'] = $this->windowSize;
        }
        if (null !== $this->queryWeight) {
            $body['query']['query_weight'] = $this->queryWeight;
        }
        if (null !== $this->rescoreQueryWeight) {
            $body['query']['rescore_query_weight'] = $this->rescoreQueryWeight;
        }
        if (null !== $this->scoreMode) {
            $body['query']['score_mode'] = $this->scoreMode;
        }

        $body['query']['rescore_query'] = $this->query->jsonSerialize();

        return $body;
    }
}
