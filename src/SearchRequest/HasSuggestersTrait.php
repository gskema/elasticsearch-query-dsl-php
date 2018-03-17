<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Suggester\SuggesterInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-suggesters.html
 * @see HasSuggestersTraitTest
 */
trait HasSuggestersTrait
{
    /** @var SuggesterInterface[] */
    protected $suggesters = [];

    /**
     * @return SuggesterInterface[]
     */
    public function getSuggesters(): array
    {
        return $this->suggesters;
    }

    /**
     * @param string $key
     *
     * @return SuggesterInterface|null
     */
    public function getSuggester(string $key)
    {
        return $this->suggesters[$key] ?? null;
    }

    /**
     * @param SuggesterInterface[] $suggestersByKey
     *
     * @return $this
     */
    public function setSuggesters(array $suggestersByKey)
    {
        $this->suggesters = $suggestersByKey;

        return $this;
    }

    /**
     * @param string             $key
     * @param SuggesterInterface $suggester
     *
     * @return $this
     */
    public function setSuggester(string $key, SuggesterInterface $suggester)
    {
        $this->suggesters[$key] = $suggester;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function removeSuggester(string $key)
    {
        unset($this->suggesters[$key]);

        return $this;
    }
}
