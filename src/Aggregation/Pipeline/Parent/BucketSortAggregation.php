<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\PipelineAggregationInterface;
use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;
use Gskema\ElasticsearchQueryDSL\SearchRequest\HasSortersTrait;
use Gskema\ElasticsearchQueryDSL\Sorter\SorterInterface;

use function Gskema\ElasticsearchQueryDSL\array_clone;

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
