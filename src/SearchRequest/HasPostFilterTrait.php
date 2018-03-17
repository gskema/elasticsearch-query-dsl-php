<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-post-filter.html
 * @see HasPostFilterTraitTest
 */
trait HasPostFilterTrait
{
    /** @var MatcherInterface|null */
    protected $postFilter;

    /**
     * @return MatcherInterface|null
     */
    public function getPostFilter()
    {
        return $this->postFilter;
    }

    /**
     * @param MatcherInterface|null $filter
     *
     * @return $this
     */
    public function setPostFilter(MatcherInterface $filter = null)
    {
        $this->postFilter = $filter;

        return $this;
    }
}
