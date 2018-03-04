<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\PipelineAggregationInterface;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-pipeline-bucket-selector-aggregation.html
 * @see SerialDifferencingBucketAggregationTest
 *
 * @options 'lag' => 1,
 *          'gap_policy' => 'skip', 'insert_zeros',
 *          'format' => ?,
 */
class SerialDifferencingBucketAggregation implements PipelineAggregationInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $bucketsPath;

    public function __construct(string $bucketsPath, array $options = [])
    {
        $this->bucketsPath = $bucketsPath;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['buckets_path'] = $this->bucketsPath;
        $body += $this->options;

        return [
            'serial_diff' => $body,
        ];
    }
}
