<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\Aggregation\AggregationInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket.html
 */
interface BucketAggregationInterface extends AggregationInterface
{
    /**
     * @return AggregationInterface[]
     */
    public function getAggs(): array;

    /**
     * @param string $key
     *
     * @return AggregationInterface|null
     */
    public function getAgg(string $key);

    /**
     * @param AggregationInterface[] $aggs
     *
     * @return $this
     */
    public function setAggs(array $aggs);

    /**
     * @param string               $key
     * @param AggregationInterface $agg
     *
     * @return $this
     */
    public function setAgg(string $key, AggregationInterface $agg);

    /**
     * @return $this
     */
    public function removeAggs();

    /**
     * @param string $key
     *
     * @return $this
     */
    public function removeAgg(string $key);

    /**
     * @return bool
     */
    public function hasAggs(): bool;

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasAgg(string $key): bool;
}
