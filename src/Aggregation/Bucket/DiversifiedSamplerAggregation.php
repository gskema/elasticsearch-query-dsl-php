<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\HasAggsTrait;
use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticsearchQueryDSL\Options;
use InvalidArgumentException;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-diversified-sampler-aggregation.html
 * @see DiversifiedSamplerAggregationTest
 */
#[Options([
    'shard_size' => 100,
    'max_docs_per_value' => 1,
    'execution_hint' => 'global_ordinals', // 'map', 'bytes_hash'
])]
class DiversifiedSamplerAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

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
        $this->aggs = array_clone($this->aggs);
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
        $aggBody = [];
        if (null !== $this->field) {
            $aggBody['field'] = $this->field;
        }
        if (null !== $this->script) {
            $aggBody['script'] = $this->script;
        }
        $aggBody += $this->options;

        $body = [];
        $body['diversified_sampler'] = $aggBody;
        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
