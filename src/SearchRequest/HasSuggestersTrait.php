<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\Suggester\SuggesterInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-suggesters.html
 * @see HasSuggestersTraitTest
 */
trait HasSuggestersTrait
{
    /** @var array<string, SuggesterInterface> */
    protected array $suggesters = [];

    /**
     * @return array<string, SuggesterInterface>
     */
    public function getSuggesters(): array
    {
        return $this->suggesters;
    }

    public function getSuggester(string $key): ?SuggesterInterface
    {
        return $this->suggesters[$key] ?? null;
    }

    /**
     * @param array<string, SuggesterInterface> $keySuggesterMap
     */
    public function setSuggesters(array $keySuggesterMap): static
    {
        $this->suggesters = $keySuggesterMap;
        return $this;
    }

    public function setSuggester(string $key, SuggesterInterface $suggester): static
    {
        $this->suggesters[$key] = $suggester;
        return $this;
    }

    public function removeSuggester(string $key): static
    {
        unset($this->suggesters[$key]);
        return $this;
    }
}
