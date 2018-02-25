<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search.html#stats-groups
 */
trait HasStatGroupsTrait
{
    /** @var string[] */
    protected $statGroups = [];

    /**
     * @return string[]
     */
    public function getStatGroups(): array
    {
        return $this->statGroups;
    }

    /**
     * @param string[] $statGroups
     *
     * @return $this
     */
    public function setStatGroups(array $statGroups)
    {
        $this->statGroups = $statGroups;

        return $this;
    }

    /**
     * @param string $statGroup
     *
     * @return $this
     */
    public function addStatGroup(string $statGroup)
    {
        $this->statGroups[] = $statGroup;

        return $this;
    }
}
