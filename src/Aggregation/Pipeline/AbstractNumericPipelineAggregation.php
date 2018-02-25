<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

abstract class AbstractNumericPipelineAggregation implements PipelineAggregationInterface
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
        $body['buckets_path'] = $this->bucketsPath;
        $body += $this->options;

        return [
            $this->getType() => $body,
        ];
    }

    abstract protected function getType(): string;
}
