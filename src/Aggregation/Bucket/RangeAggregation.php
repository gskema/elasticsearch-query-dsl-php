<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticSearchQueryDSL\Options;
use InvalidArgumentException;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use function Gskema\ElasticSearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-range-aggregation.html
 * @see RangeAggregationTest
 */
#[Options([
    'keyed' => true,
])]
class RangeAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /**
     * @param array<string, mixed> $options
     */
    protected function __construct(
        protected ?string $field,
        protected ?ScriptInterface $script,
        /** @var array<string, mixed>[] ['from' => 5, 'to' => 5, 'key' => 'custom_bucket_key'], */
        protected array $ranges,
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
     * @param array<string, mixed>[] $ranges
     * @param array<string, mixed> $options
     */
    public static function fromField(
        string $field,
        array $ranges,
        array $options = [],
        ?InlineScript $valueScript = null,
    ): static {
        return new static($field, $valueScript, $ranges, $options);
    }

    /**
     * @param mixed[][] $ranges
     * @param array<string, mixed> $options
     */
    public static function fromScript(ScriptInterface $script, array $ranges, array $options = []): static
    {
        return new static(null, $script, $ranges, $options);
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
        $aggBody['ranges'] = $this->ranges;
        $aggBody += $this->options;

        $body = ['range' => $aggBody];
        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
