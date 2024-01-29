<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-from-size.html
 * @see HasFromTraitTest
 */
trait HasFromTrait
{
    protected ?int $from = null;

    public function getFrom(): ?int
    {
        return $this->from;
    }

    public function setFrom(?int $from): static
    {
        $this->from = $from;
        return $this;
    }
}
