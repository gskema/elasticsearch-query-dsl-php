<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticsearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticsearchQueryDSL\Options;
use InvalidArgumentException;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-percentile-rank-aggregation.html
 * @see PercentileRanksAggregationTest
 */
#[Options([
    'keyed' => true,
    'hdr' => ['number_of_significant_value_digits' => 3],
    'missing' => 10,
])]
class PercentileRanksAggregation implements MetricAggregationInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    protected function __construct(
        protected ?string $field,
        protected ?ScriptInterface $script,
        /** @var float[]|int[] */
        protected array $values,
        array $options = [],
    ) {
        if (null === $field && null === $script) {
            throw new InvalidArgumentException('Expected at least one to be not null: field or script.');
        }
        $this->options = $options;
    }

    public function __clone()
    {
        if (null !== $this->script) {
            $this->script = clone $this->script;
        }
    }

    /**
     * @param float[]|int[] $values
     * @param array<string, mixed> $options
     */
    public static function fromField(
        string $field,
        array $values,
        array $options = [],
        ?InlineScript $valueScript = null,
    ): static {
        return new static($field, $valueScript, $values, $options);
    }

    /**
     * @param float[]|int[] $values
     * @param array<string, mixed> $options
     */
    public static function fromScript(
        array $values,
        ScriptInterface $script,
        array $options = [],
    ): static {
        return new static(null, $script, $values, $options);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['values'] = $this->values;
        if (null !== $this->field) {
            $body['field'] = $this->field;
        }
        if (null !== $this->script) {
            $body['script'] = $this->script->jsonSerialize();
        }
        $body += $this->options;

        return [
            'percentile_ranks' => $body,
        ];
    }
}
