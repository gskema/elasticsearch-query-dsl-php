<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\Sorter\SorterInterface;

use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-sort.html
 * @see HasSortersTraitTest
 */
trait HasSortersTrait
{
    /** @var SorterInterface[] */
    protected array $sorters = [];

    /**
     * @return SorterInterface[]
     */
    public function getSorters(): array
    {
        return $this->sorters;
    }

    /**
     * @param SorterInterface[] $sorters
     */
    public function setSorters(array $sorters): static
    {
        $this->sorters = $sorters;
        return $this;
    }

    public function addSorter(SorterInterface $sorter): static
    {
        $this->sorters[] = $sorter;
        return $this;
    }

    protected function jsonSerializeSorters(): mixed
    {
        $rawSorters = obj_array_json_serialize($this->sorters);
        return 1 === count($this->sorters) ? $rawSorters[0] : $rawSorters;
    }
}
