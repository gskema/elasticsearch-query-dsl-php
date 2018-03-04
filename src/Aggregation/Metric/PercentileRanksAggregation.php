<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-percentile-rank-aggregation.html
 * @see PercentileRanksAggregationTest
 *
 * @options 'keyed' => true,
 *          'hdr' => ['number_of_significant_value_digits' => 3],
 *          'missing' => 10,
 */
class PercentileRanksAggregation implements MetricAggregationInterface
{
    use HasOptionsTrait;

    /** @var array */
    protected $body;

    protected function __construct(array $body, array $options = [])
    {
        $this->body = $body;
        $this->options = $options;
    }

    /**
     * @param string            $field
     * @param float[]           $values
     * @param array             $options
     * @param InlineScript|null $valueScript
     *
     * @return PercentileRanksAggregation
     */
    public static function fromField(
        string $field,
        array $values,
        array $options = [],
        InlineScript $valueScript = null
    ): PercentileRanksAggregation {
        $body = [];
        $body['values'] = $values;
        $body['field'] = $field;
        if (null !== $valueScript) {
            $body['script'] = $valueScript->jsonSerialize();
        }

        return new static($body, $options);
    }

    /**
     * @param float[]         $values
     * @param ScriptInterface $script
     * @param array           $options
     *
     * @return PercentileRanksAggregation
     */
    public static function fromScript(
        array $values,
        ScriptInterface $script,
        array $options = []
    ): PercentileRanksAggregation {
        $body['values'] = $values;
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
            'percentile_ranks' => $body,
        ];
    }
}
