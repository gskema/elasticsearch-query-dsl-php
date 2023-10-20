<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

abstract class AbstractNumericPipelineAggregation implements PipelineAggregationInterface
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
            $this->getType() => $body,
        ];
    }

    /**
     * @return string 'avg', 'cumulative_sum', 'derivative', ...
     */
    abstract protected function getType(): string;
}
