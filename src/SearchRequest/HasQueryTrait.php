<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-query.html
 */
trait HasQueryTrait
{
    /** @var MatcherInterface|null */
    protected $query;

    /**
     * @return MatcherInterface|null
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param MatcherInterface|null $query
     *
     * @return $this
     */
    public function setQuery(MatcherInterface $query = null)
    {
        $this->query = $query;

        return $this;
    }
}
