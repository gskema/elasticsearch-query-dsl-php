<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-query.html
 * @see HasQueryTraitTest
 */
trait HasQueryTrait
{
    protected ?MatcherInterface $query = null;

    public function getQuery(): ?MatcherInterface
    {
        return $this->query;
    }

    public function setQuery(?MatcherInterface $query): static
    {
        $this->query = $query;
        return $this;
    }
}
