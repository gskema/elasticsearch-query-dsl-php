<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-from-size.html
 */
trait HasFromTrait
{
    /** @var int|null */
    protected $from;

    /**
     * @return int|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param int|null $from
     *
     * @return $this
     */
    public function setFrom(int $from = null)
    {
        $this->from = $from;

        return $this;
    }
}
