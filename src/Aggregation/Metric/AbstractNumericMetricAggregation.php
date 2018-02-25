<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

abstract class AbstractNumericMetricAggregation implements MetricAggregationInterface
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
    ): AbstractNumericMetricAggregation {
        $body['field'] = $field;
        if (null !== $valueScript) {
            $body['script'] = $valueScript->jsonSerialize();
        }

        return new static($body, $options);
    }

    public static function fromScript(ScriptInterface $script, array $options = []): AbstractNumericMetricAggregation
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
            $this->getType() => $body,
        ];
    }

    /**
     * Returns aggregation type, e.g. min, max, avg, sum or stats.
     *
     * @return string
     */
    abstract protected function getType(): string;
}
