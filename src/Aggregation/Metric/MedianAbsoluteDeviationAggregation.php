<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-median-absolute-deviation-aggregation.html
 * @see MedianAbsoluteDeviationAggregationTest
 */
#[Options([
    'compression' => 100,
    'missing' => 4,
])]
class MedianAbsoluteDeviationAggregation implements MetricAggregationInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected ScriptInterface|string $fieldOrScript,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone(): void
    {
        if (is_object($this->fieldOrScript)) {
            $this->fieldOrScript = clone $this->fieldOrScript;
        }
    }

    public function jsonSerialize(): mixed
    {
        $body = $this->options;

        if ($this->fieldOrScript instanceof ScriptInterface) {
            $body['script'] = $this->fieldOrScript->jsonSerialize();
        } else {
            $body['field'] = $this->fieldOrScript;
        }

        return ['median_absolute_deviation' => $body];
    }
}
