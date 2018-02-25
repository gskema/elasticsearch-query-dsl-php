<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Sorter\SorterInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-sort.html
 */
trait HasSortersTrait
{
    /** @var SorterInterface[] */
    protected $sorters = [];

    /**
     * @return SorterInterface[]
     */
    public function getSorters(): array
    {
        return $this->sorters;
    }

    /**
     * @param SorterInterface[] $sorters
     *
     * @return $this
     */
    public function setSorters(array $sorters)
    {
        $this->sorters = $sorters;

        return $this;
    }

    /**
     * @param SorterInterface $sorter
     *
     * @return $this
     */
    public function addSorter(SorterInterface $sorter)
    {
        $this->sorters[] = $sorter;

        return $this;
    }
}
