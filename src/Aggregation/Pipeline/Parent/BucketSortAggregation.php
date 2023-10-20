<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\PipelineAggregationInterface;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Options;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasSortersTrait;
use Gskema\ElasticSearchQueryDSL\Sorter\SorterInterface;

use function Gskema\ElasticSearchQueryDSL\array_clone;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-pipeline-bucket-sort-aggregation.html
 * @see BucketSortAggregationTest
 */
#[Options([
    'gap_policy' => 'skip', // 'insert_zeros',
    'size' => 1,
    'from' => 3,
])]
class BucketSortAggregation implements PipelineAggregationInterface
{
    use HasSortersTrait;
    use HasOptionsTrait;

    /**
     * @param SorterInterface[]|SorterInterface $sorters
     * @param array<string, mixed> $options
     */
    public function __construct(
        array|SorterInterface $sorters = [],
        protected ?int $from = null,
        protected ?int $size = null,
        array $options = [],
    ) {
        if (!empty($sorters)) {
            $this->sorters = is_array($sorters) ? $sorters : [$sorters];
        }
        $this->options = $options;
    }

    public function __clone()
    {
        $this->sorters = array_clone($this->sorters);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = $this->options;
        if (!empty($this->sorters)) {
            $body['sort'] = $this->jsonSerializeSorters();
        }
        if (null !== $this->from) {
            $body['from'] = $this->from;
        }
        if (null !== $this->size) {
            $body['size'] = $this->size;
        }

        return [
            'bucket_sort' => $body,
        ];
    }
}
