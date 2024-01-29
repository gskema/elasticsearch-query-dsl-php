<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Compound;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;
use stdClass;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-bool-query.html
 * @see BoolMatcherTest
 */
#[Options([
    'boost' => 1.0,
    '_name' => '?',
])]
class BoolMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    public function __construct(
        /** @var MatcherInterface[] */
        protected array $filters = [],
        /** @var MatcherInterface[] */
        protected array $musts = [],
        /** @var MatcherInterface[] */
        protected array $mustNots = [],
        /** @var MatcherInterface[] */
        protected array $shoulds = [],
        protected string|int|null $minimumShouldMatch = null,
    ) {
    }

    public function __clone()
    {
        $this->filters = array_clone($this->filters);
        $this->musts = array_clone($this->musts);
        $this->mustNots = array_clone($this->mustNots);
        $this->shoulds = array_clone($this->shoulds);
    }

    /**
     * @return MatcherInterface[]
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @param MatcherInterface[] $filters
     */
    public function setFilters(array $filters): static
    {
        $this->filters = $filters;
        return $this;
    }

    public function addFilter(MatcherInterface $filter): static
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
     */
    public function setMusts(array $matchers): static
    {
        $this->musts = $matchers;
        return $this;
    }

    public function addMust(MatcherInterface $matcher): static
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
     */
    public function setMustNots(array $matchers): static
    {
        $this->mustNots = $matchers;
        return $this;
    }

    public function addMustNot(MatcherInterface $matcher): static
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
     */
    public function setShoulds(array $matchers): static
    {
        $this->shoulds = $matchers;
        return $this;
    }

    public function addShould(MatcherInterface $matcher): static
    {
        $this->shoulds[] = $matcher;
        return $this;
    }

    public function getMinimumShouldMatch(): string|int|null
    {
        return $this->minimumShouldMatch;
    }

    public function setMinimumShouldMatch(string|int|null $minimumShouldMatch): static
    {
        $this->minimumShouldMatch = $minimumShouldMatch;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];

        if (!empty($this->filters)) {
            $rawFilters = obj_array_json_serialize($this->filters);
            $body['filter'] = 1 === count($this->filters) ? $rawFilters[0] : $rawFilters;
        }

        if (!empty($this->musts)) {
            $rawMusts = obj_array_json_serialize($this->musts);
            $body['must'] = 1 === count($this->musts) ? $rawMusts[0] : $rawMusts;
        }

        if (!empty($this->mustNots)) {
            $rawMustNots = obj_array_json_serialize($this->mustNots);
            $body['must_not'] = 1 === count($this->mustNots) ? $rawMustNots[0] : $rawMustNots;
        }

        if (!empty($this->shoulds)) {
            $rawShoulds = obj_array_json_serialize($this->shoulds);
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
