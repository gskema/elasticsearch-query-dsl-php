<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use InvalidArgumentException;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-adjacency-matrix-aggregation.html
 * @see AdjacencyMatrixAggregationTest
 */
class AdjacencyMatrixAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    /** @var MatcherInterface[] */
    protected $filters;

    /**
     * @param MatcherInterface[] $filtersByName
     */
    public function __construct(array $filtersByName)
    {
        if (empty($filtersByName)) {
            throw new InvalidArgumentException('Expected at least one filter, got none');
        }
        $this->filters = $filtersByName;
    }

    public function __clone()
    {
        $this->filters = array_clone($this->filters);
        $this->aggs = array_clone($this->aggs);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['adjacency_matrix']['filters'] = array_map(function (MatcherInterface $filter) {
            return $filter->jsonSerialize();
        }, $this->filters);

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
