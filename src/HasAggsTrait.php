<?php

namespace Gskema\ElasticsearchQueryDSL;

use Gskema\ElasticsearchQueryDSL\Aggregation\AggregationInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations.html
 * @see HasAggsTraitTest
 */
trait HasAggsTrait
{
    /** @var array<string, AggregationInterface> */
    protected array $aggs = [];

    /**
     * @inheritDoc
     */
    public function getAggs(): array
    {
        return $this->aggs;
    }

    public function getAgg(string $key): ?AggregationInterface
    {
        return $this->aggs[$key] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function setAggs(array $keyAggMap): static
    {
        $this->aggs = $keyAggMap;
        return $this;
    }

    public function setAgg(string $key, AggregationInterface $agg): static
    {
        $this->aggs[$key] = $agg;
        return $this;
    }

    public function removeAggs(): static
    {
        $this->aggs = [];
        return $this;
    }

    public function removeAgg(string $key): static
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
}
