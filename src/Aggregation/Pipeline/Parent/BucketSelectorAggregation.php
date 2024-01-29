<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\PipelineAggregationInterface;
use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-pipeline-bucket-selector-aggregation.html
 * @see BucketSelectorAggregationTest
 */
#[Options([
    'gap_policy' => 'skip',// 'insert_zeros',
])]
class BucketSelectorAggregation implements PipelineAggregationInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        /** @var array<string, string> */
        protected array $bucketsPath,
        protected ScriptInterface $script,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->script = clone $this->script;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [
            'buckets_path' => $this->bucketsPath,
            'script' => $this->script->jsonSerialize(),
        ];
        $body += $this->options;

        return [
            'bucket_selector' => $body,
        ];
    }
}
