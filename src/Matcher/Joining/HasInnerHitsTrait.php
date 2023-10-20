<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHitsRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-inner-hits.html
 * @see HasInnerHitsTraitTest
 */
trait HasInnerHitsTrait
{
    protected ?InnerHitsRequest $innerHits = null;

    public function getInnerHits(): ?InnerHitsRequest
    {
        return $this->innerHits;
    }

    public function setInnerHits(?InnerHitsRequest $request): static
    {
        $this->innerHits = $request;
        return $this;
    }

    public function hasInnerHits(): bool
    {
        return null !== $this->innerHits;
    }
}
