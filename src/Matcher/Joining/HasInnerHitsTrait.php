<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHitsRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-inner-hits.html
 * @see HasInnerHitsTraitTest
 */
trait HasInnerHitsTrait
{
    /** @var InnerHitsRequest|null */
    protected $innerHits;

    /**
     * @return InnerHitsRequest|null
     */
    public function getInnerHits()
    {
        return $this->innerHits;
    }

    /**
     * @param InnerHitsRequest|null $request
     *
     * @return $this
     */
    public function setInnerHits(InnerHitsRequest $request = null)
    {
        $this->innerHits = $request;

        return $this;
    }

    public function hasInnerHits(): bool
    {
        return null !== $this->innerHits;
    }
}
