<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-valuecount-aggregation.html
 * @see ValueCountAggregationTest
 */
class ValueCountAggregation implements MetricAggregationInterface
{
    /** @var array */
    protected $body;

    protected function __construct(array $body)
    {
        $this->body = $body;
    }

    public static function fromField(string $field): ValueCountAggregation
    {
        return new static(['field' => $field]);
    }

    public static function fromScript(ScriptInterface $script): ValueCountAggregation
    {
        return new static(['script' => $script->jsonSerialize()]);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'value_count' => $this->body,
        ];
    }
}
