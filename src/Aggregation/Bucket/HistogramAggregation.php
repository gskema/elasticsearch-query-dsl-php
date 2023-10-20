<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticSearchQueryDSL\Options;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use function Gskema\ElasticSearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-histogram-aggregation.html
 * @see HistogramAggregationTest
 */
#[Options([
    'min_doc_count' => 1,
    'extended_bounds' => ['min' => 0, 'max' => 500],
    'order' => ['_key' => 'desc'],
    'offset' => 5,
    'keyed' => true,
    'missing' => 0,
])]
class HistogramAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /**
     * @param array<string, mixed> $options
     */
    protected function __construct(
        protected ?string $field,
        protected ?ScriptInterface $script,
        protected float $interval,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        if (null !== $this->script) {
            $this->script = clone $this->script;
        }
        $this->aggs = array_clone($this->aggs);
    }

    /**
     * @param array<string, mixed> $options
     */
    public static function fromField(
        string $field,
        float $interval,
        array $options = [],
        ?InlineScript $valueScript = null,
    ): static {
        return new static($field, $valueScript, $interval, $options);
    }

    /**
     * @param array<string, mixed> $options
     */
    public static function fromScript(ScriptInterface $script, float $interval, array $options = []): static
    {
        return new static(null, $script, $interval, $options);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $aggBody = [];
        if (null !== $this->field) {
            $aggBody['field'] = $this->field;
        }
        if (null !== $this->script) {
            $aggBody['script'] = $this->script;
        }
        $aggBody['interval'] = $this->interval;
        $aggBody += $this->options;

        $body = [];
        $body['histogram'] = $aggBody;
        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
