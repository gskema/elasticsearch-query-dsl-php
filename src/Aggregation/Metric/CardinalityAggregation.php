<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticSearchQueryDSL\Options;
use InvalidArgumentException;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-cardinality-aggregation.html
 * @see CardinalityAggregationTest
 */
#[Options([
    'precision_threshold' => 3000,
    'missing' => 'N/A',
])]
class CardinalityAggregation implements MetricAggregationInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    protected function __construct(
        protected ?string $field,
        protected ?ScriptInterface $script,
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
     * @param array<string, mixed> $options
     */
    public static function fromField(string $field, array $options = []): static
    {
        return new static($field, null, $options);
    }

    /**
     * @param array<string, mixed> $options
     */
    public static function fromScript(ScriptInterface $script, array $options = []): static
    {
        return new static(null, $script, $options);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        if (null !== $this->field) {
            $body['field'] = $this->field;
        }
        if (null !== $this->script) {
            $body['script'] = $this->script;
        }
        $body += $this->options;

        return [
            'cardinality' => $body,
        ];
    }
}
