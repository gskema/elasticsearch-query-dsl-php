<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\PipelineAggregationInterface;
use Gskema\ElasticsearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-pipeline-movfn-aggregation.html
 * @see MovingFunctionAggregationTest
 */
class MovingFunctionAggregation implements PipelineAggregationInterface
{
    public function __construct(
        protected string $bucketsPath,
        protected int $window,
        protected ScriptInterface $script,
    ) {
    }

    public function __clone(): void
    {
        $this->script = clone $this->script;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'moving_fn' => [
                'buckets_path' => $this->bucketsPath,
                'window' => $this->window,
                'script' => $this->script->jsonSerialize(),
            ],
        ];
    }
}
