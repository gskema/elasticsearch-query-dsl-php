<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHits\InnerHitsRequestInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-inner-hits.html
 * @see HasInnerHitsTraitTest
 */
trait HasInnerHitsTrait
{
    protected ?InnerHitsRequestInterface $innerHits = null;

    public function getInnerHits(): ?InnerHitsRequestInterface
    {
        return $this->innerHits;
    }

    public function setInnerHits(?InnerHitsRequestInterface $request): static
    {
        $this->innerHits = $request;
        return $this;
    }

    public function hasInnerHits(): bool
    {
        return null !== $this->innerHits;
    }
}
