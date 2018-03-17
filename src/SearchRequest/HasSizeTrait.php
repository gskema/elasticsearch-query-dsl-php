<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-from-size.html
 * @see HasSizeTraitTest
 */
trait HasSizeTrait
{
    /** @var int|null */
    protected $size;

    /**
     * @return int|null
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int|null $size
     *
     * @return $this
     */
    public function setSize(int $size = null)
    {
        $this->size = $size;

        return $this;
    }
}
