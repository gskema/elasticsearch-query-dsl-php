<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-cardinality-aggregation.html
 * @see CardinalityAggregationTest
 *
 * @options 'precision_threshold' => 3000,
 *          'missing' => 'N/A',
 */
class CardinalityAggregation implements MetricAggregationInterface
{
    use HasOptionsTrait;

    /** @var array */
    protected $body;

    protected function __construct(array $body, array $options = [])
    {
        $this->body = $body;
        $this->options = $options;
    }

    public static function fromField(string $field, array $options = []): CardinalityAggregation
    {
        return new static(['field' => $field], $options);
    }

    public static function fromScript(ScriptInterface $script, array $options = []): CardinalityAggregation
    {
        return new static(['script' => $script->jsonSerialize()], $options);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = $this->body;
        $body += $this->options;

        return [
            'cardinality' => $body,
        ];
    }
}
