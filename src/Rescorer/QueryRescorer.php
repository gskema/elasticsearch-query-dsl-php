<?php

namespace Gskema\ElasticsearchQueryDSL\Rescorer;

use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-rescore.html
 * @see QueryRescorerTest
 */
class QueryRescorer implements RescorerInterface
{
    protected ?float $queryWeight = null;
    protected ?float $rescoreQueryWeight = null;
    /** 'total', 'multiply', 'avg', 'max', 'min' */
    protected ?string $scoreMode = null;
    protected ?int $windowSize = null;

    public function __construct(
        protected MatcherInterface $query,
    ) {
    }

    public function __clone()
    {
        $this->query = clone $this->query;
    }

    public function getQuery(): MatcherInterface
    {
        return $this->query;
    }

    public function getQueryWeight(): ?float
    {
        return $this->queryWeight;
    }

    public function setQueryWeight(?float $queryWeight): static
    {
        $this->queryWeight = $queryWeight;
        return $this;
    }

    public function getRescoreQueryWeight(): ?float
    {
        return $this->rescoreQueryWeight;
    }

    public function setRescoreQueryWeight(?float $rescoreQueryWeight): static
    {
        $this->rescoreQueryWeight = $rescoreQueryWeight;
        return $this;
    }

    public function getScoreMode(): ?string
    {
        return $this->scoreMode;
    }

    public function setScoreMode(?string $scoreMode): static
    {
        $this->scoreMode = $scoreMode;
        return $this;
    }

    public function getWindowSize(): ?int
    {
        return $this->windowSize;
    }

    public function setWindowSize(?int $windowSize): static
    {
        $this->windowSize = $windowSize;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
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
