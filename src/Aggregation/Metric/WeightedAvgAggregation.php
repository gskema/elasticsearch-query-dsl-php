<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-weight-avg-aggregation.html
 * @see WeightedAvgAggregationTest
 */
#[Options([
    'format' => '?',
    'value_type' => '?'
])]
class WeightedAvgAggregation implements MetricAggregationInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string|ScriptInterface $valueFieldOrScript,
        protected string|ScriptInterface $weightFieldOrScript,
        protected mixed $missingValue = null,
        protected mixed $missingWeight = null,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        if (is_object($this->valueFieldOrScript)) {
            $this->valueFieldOrScript = clone $this->valueFieldOrScript;
        }
        if (is_object($this->weightFieldOrScript)) {
            $this->weightFieldOrScript = clone $this->weightFieldOrScript;
        }
    }

    public function jsonSerialize(): mixed
    {
        $body = $this->options;

        if ($this->valueFieldOrScript instanceof ScriptInterface) {
            $body['value']['script'] = $this->valueFieldOrScript->jsonSerialize();
        } else {
            $body['value']['field'] = $this->valueFieldOrScript;
        }

        if ($this->weightFieldOrScript instanceof ScriptInterface) {
            $body['weight']['script'] = $this->weightFieldOrScript->jsonSerialize();
        } else {
            $body['weight']['field'] = $this->weightFieldOrScript;
        }

        if (null !== $this->missingValue) {
            $body['value']['missing'] = $this->missingValue;
        }
        if (null !== $this->missingWeight) {
            $body['weight']['missing'] = $this->missingWeight;
        }

        return ['weighted_avg' => $body];
    }
}
