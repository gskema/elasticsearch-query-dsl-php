<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\PipelineAggregationInterface;
use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-pipeline-serialdiff-aggregation.html
 * @see SerialDifferencingBucketAggregationTest
 */
#[Options([
    'lag' => 1,
    'gap_policy' => 'skip', // 'insert_zeros',
    'format' => '?',
])]
class SerialDifferencingBucketAggregation implements PipelineAggregationInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $bucketsPath,
        array $options = [],
    ) {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['buckets_path'] = $this->bucketsPath;
        $body += $this->options;

        return [
            'serial_diff' => $body,
        ];
    }
}
