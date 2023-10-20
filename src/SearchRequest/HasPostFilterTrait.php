<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-post-filter.html
 * @see HasPostFilterTraitTest
 */
trait HasPostFilterTrait
{
    protected ?MatcherInterface $postFilter = null;

    public function getPostFilter(): ?MatcherInterface
    {
        return $this->postFilter;
    }

    public function setPostFilter(?MatcherInterface $filter): static
    {
        $this->postFilter = $filter;
        return $this;
    }
}
