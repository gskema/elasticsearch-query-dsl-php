<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\Aggregation\AggregationInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket.html
 */
interface BucketAggregationInterface extends AggregationInterface
{
    /**
     * @return array<string, AggregationInterface>
     */
    public function getAggs(): array;

    public function getAgg(string $key): ?AggregationInterface;

    /**
     * @param array<string, AggregationInterface> $keyAggMap
     */
    public function setAggs(array $keyAggMap): static;

    public function setAgg(string $key, AggregationInterface $agg): static;

    public function removeAggs(): static;

    public function removeAgg(string $key): static;

    public function hasAggs(): bool;

    public function hasAgg(string $key): bool;
}
