<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\HasAggsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use InvalidArgumentException;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-adjacency-matrix-aggregation.html
 * @see AdjacencyMatrixAggregationTest
 */
class AdjacencyMatrixAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    public function __construct(
        /** @var array<string, MatcherInterface> */
        protected array $filters,
    ) {
        if (empty($filters)) {
            throw new InvalidArgumentException('Expected at least one filter, got none');
        }
    }

    public function __clone()
    {
        $this->filters = array_clone($this->filters);
        $this->aggs = array_clone($this->aggs);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['adjacency_matrix']['filters'] = obj_array_json_serialize($this->filters);

        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
