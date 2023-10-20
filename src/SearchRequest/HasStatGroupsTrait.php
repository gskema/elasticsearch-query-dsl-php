<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search.html#stats-groups
 * @see HasStatGroupsTraitTest
 */
trait HasStatGroupsTrait
{
    /** @var string[] */
    protected array $statGroups = [];

    /**
     * @return string[]
     */
    public function getStatGroups(): array
    {
        return $this->statGroups;
    }

    /**
     * @param string[] $statGroups
     */
    public function setStatGroups(array $statGroups): static
    {
        $this->statGroups = $statGroups;
        return $this;
    }

    public function addStatGroup(string $statGroup): static
    {
        $this->statGroups[] = $statGroup;
        return $this;
    }
}
