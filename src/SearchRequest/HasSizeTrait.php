<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-from-size.html
 * @see HasSizeTraitTest
 */
trait HasSizeTrait
{
    protected ?int $size = null;

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): static
    {
        $this->size = $size;
        return $this;
    }
}
