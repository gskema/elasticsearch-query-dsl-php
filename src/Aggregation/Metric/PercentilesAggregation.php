<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-percentile-aggregation.html
 * @see PercentilesAggregationTest
 *
 * @options 'keyed' => true,
 *          'percents' => [95, 99, 99.9],
 *          'tdigest' => ['compression' => 200],
 *          'hdr' => ['number_of_significant_value_digits' => 3],
 *          'missing' => 10,
 */
class PercentilesAggregation implements MetricAggregationInterface
{
    use HasOptionsTrait;

    /** @var array */
    protected $body;

    protected function __construct(array $body, array $options = [])
    {
        $this->body = $body;
        $this->options = $options;
    }

    public static function fromField(
        string $field,
        array $options = [],
        InlineScript $valueScript = null
    ): PercentilesAggregation {
        $body = [];
        $body['field'] = $field;
        if (null !== $valueScript) {
            $body['script'] = $valueScript->jsonSerialize();
        }

        return new static($body, $options);
    }

    public static function fromScript(ScriptInterface $script, array $options = []): PercentilesAggregation
    {
        $body = [];
        $body['script'] = $script->jsonSerialize();

        return new static($body, $options);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = $this->body;
        $body += $this->options;

        return [
            'percentiles' => $body,
        ];
    }
}
