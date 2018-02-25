<?php

namespace Gskema\ElasticSearchQueryDSL;

use Gskema\ElasticSearchQueryDSL\Aggregation\AggregationInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations.html
 */
trait HasAggsTrait
{
    /** @var AggregationInterface[] */
    protected $aggs = [];

    /**
     * @return AggregationInterface[]
     */
    public function getAggs(): array
    {
        return $this->aggs;
    }

    /**
     * @param string $key
     *
     * @return AggregationInterface|null
     */
    public function getAgg(string $key)
    {
        return $this->aggs[$key] ?? null;
    }

    /**
     * @param AggregationInterface[] $aggsByKey
     *
     * @return $this
     */
    public function setAggs(array $aggsByKey)
    {
        $this->aggs = $aggsByKey;

        return $this;
    }

    /**
     * @param string               $key
     * @param AggregationInterface $agg
     *
     * @return $this
     */
    public function setAgg(string $key, AggregationInterface $agg)
    {
        $this->aggs[$key] = $agg;

        return $this;
    }

    /**
     * @return $this
     */
    public function removeAggs()
    {
        $this->aggs = [];

        return $this;
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function removeAgg(string $key)
    {
        unset($this->aggs[$key]);

        return $this;
    }

    public function hasAggs(): bool
    {
        return !empty($this->aggs);
    }

    public function hasAgg(string $key): bool
    {
        return key_exists($key, $this->aggs);
    }

    protected function jsonSerializeAggs(): array
    {
        return array_map(function (AggregationInterface $agg) {
            return $agg->jsonSerialize();
        }, $this->aggs);
    }
}
