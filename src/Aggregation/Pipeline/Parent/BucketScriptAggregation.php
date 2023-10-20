<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\PipelineAggregationInterface;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-pipeline-bucket-script-aggregation.html
 * @see BucketScriptAggregationTest
 */
#[Options([
    'gap_policy' => 'skip', // 'insert_zeros',
    'format' => '?',
])]
class BucketScriptAggregation implements PipelineAggregationInterface
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
            'bucket_script' => $body,
        ];
    }
}
