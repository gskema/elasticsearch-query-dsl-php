<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-bool-query.html
 * @see BoolMatcherTest
 *
 * @options 'boost' => 1.0,
 *          '_name' => '?',
 */
class BoolMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var MatcherInterface[] */
    protected $filters = [];

    /** @var MatcherInterface[] */
    protected $musts = [];

    /** @var MatcherInterface[] */
    protected $mustNots = [];

    /** @var MatcherInterface[] */
    protected $shoulds = [];

    /** @var string|int|null */
    protected $minimumShouldMatch;

    /**
     * @return MatcherInterface[]
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @param MatcherInterface[] $filters
     *
     * @return $this
     */
    public function setFilters(array $filters): BoolMatcher
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * @param MatcherInterface $filter
     *
     * @return $this
     */
    public function addFilter(MatcherInterface $filter): BoolMatcher
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * @return MatcherInterface[]
     */
    public function getMusts(): array
    {
        return $this->musts;
    }

    /**
     * @param MatcherInterface[] $matchers
     *
     * @return $this
     */
    public function setMusts(array $matchers): BoolMatcher
    {
        $this->musts = $matchers;

        return $this;
    }

    /**
     * @param MatcherInterface $matcher
     *
     * @return $this
     */
    public function addMust(MatcherInterface $matcher): BoolMatcher
    {
        $this->musts[] = $matcher;

        return $this;
    }

    /**
     * @return MatcherInterface[]
     */
    public function getMustNots(): array
    {
        return $this->mustNots;
    }

    /**
     * @param MatcherInterface[] $matchers
     *
     * @return $this
     */
    public function setMustNots(array $matchers): BoolMatcher
    {
        $this->mustNots = $matchers;

        return $this;
    }

    /**
     * @param MatcherInterface $matcher
     *
     * @return $this
     */
    public function addMustNot(MatcherInterface $matcher): BoolMatcher
    {
        $this->mustNots[] = $matcher;

        return $this;
    }

    /**
     * @return MatcherInterface[]
     */
    public function getShoulds(): array
    {
        return $this->shoulds;
    }

    /**
     * @param MatcherInterface[] $matchers
     *
     * @return $this
     */
    public function setShoulds(array $matchers): BoolMatcher
    {
        $this->shoulds = $matchers;

        return $this;
    }

    /**
     * @param MatcherInterface $matcher
     *
     * @return $this
     */
    public function addShould(MatcherInterface $matcher): BoolMatcher
    {
        $this->shoulds[] = $matcher;

        return $this;
    }

    /**
     * @return string|int|null
     */
    public function getMinimumShouldMatch()
    {
        return $this->minimumShouldMatch;
    }

    /**
     * @param string|int|null $minimumShouldMatch
     *
     * @return $this
     */
    public function setMinimumShouldMatch($minimumShouldMatch = null): BoolMatcher
    {
        $this->minimumShouldMatch = $minimumShouldMatch;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];

        if (!empty($this->filters)) {
            $rawFilters = array_map(function (MatcherInterface $filterMatcher) {
                return $filterMatcher->jsonSerialize();
            }, $this->filters);
            $body['filter'] = 1 === count($this->filters) ? $rawFilters[0] : $rawFilters;
        }

        if (!empty($this->musts)) {
            $rawMusts = array_map(function (MatcherInterface $mustMatcher) {
                return $mustMatcher->jsonSerialize();
            }, $this->musts);
            $body['must'] = 1 === count($this->musts) ? $rawMusts[0] : $rawMusts;
        }

        if (!empty($this->mustNots)) {
            $rawMustNots = array_map(function (MatcherInterface $mustNotMatcher) {
                return $mustNotMatcher->jsonSerialize();
            }, $this->mustNots);
            $body['must_not'] = 1 === count($this->mustNots) ? $rawMustNots[0] : $rawMustNots;
        }

        if (!empty($this->shoulds)) {
            $rawShoulds = array_map(function (MatcherInterface $shouldMatcher) {
                return $shouldMatcher->jsonSerialize();
            }, $this->shoulds);
            $body['should'] = 1 === count($this->shoulds) ? $rawShoulds[0] : $rawShoulds;
        }

        if (null !== $this->minimumShouldMatch) {
            $body['minimum_should_match'] = $this->minimumShouldMatch;
        }

        $body += $this->options;
        $body = $body ?: new stdClass();

        return [
            'bool' => $body,
        ];
    }
}
