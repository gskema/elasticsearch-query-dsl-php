<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\Model\Script\ScriptInterface;
use InvalidArgumentException;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-valuecount-aggregation.html
 * @see ValueCountAggregationTest
 */
class ValueCountAggregation implements MetricAggregationInterface
{
    protected function __construct(
        protected ?string $field,
        protected ?ScriptInterface $script,
    ) {
        if (null === $field && null === $script) {
            throw new InvalidArgumentException('Expected at least one to be not null: field or script.');
        }
    }

    public function __clone()
    {
        if (null !== $this->script) {
            $this->script = clone $this->script;
        }
    }

    public static function fromField(string $field): static
    {
        return new static($field, null);
    }

    public static function fromScript(ScriptInterface $script): static
    {
        return new static(null, $script);
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

        return [
            'value_count' => $body,
        ];
    }
}
