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
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-autodatehistogram-aggregation.html
 * @see AutoIntervalDateHistogramAggregationTest
 */
#[Options([
    'format' => 'yyyy-MM-dd',
    'time_zone' => '-01:00',
    'missing' => '2000/01/01',
])]
class AutoIntervalDateHistogramAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    protected function __construct(
        protected ?string $field,
        protected ?ScriptInterface $script,
        protected int $buckets,
        array $options = [],
    ) {
        if (null === $field && null === $script) {
            throw new InvalidArgumentException('Expected at least one to be not null: field or script.');
        }
        $this->options = $options;
    }

    public function __clone(): void
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
        int $buckets,
        array $options = [],
        ?InlineScript $valueScript = null,
    ): static {
        return new static($field, $valueScript, $buckets, $options);
    }

    /**
     * @param array<string, mixed> $options
     */
    public static function fromScript(ScriptInterface $script, int $buckets, array $options = []): static
    {
        return new static(null, $script, $buckets, $options);
    }

    public function jsonSerialize(): mixed
    {
        $aggBody = [];
        if (null !== $this->field) {
            $aggBody['field'] = $this->field;
        }
        if (null !== $this->script) {
            $aggBody['script'] = $this->script;
        }
        $aggBody['buckets'] = $this->buckets;
        $aggBody += $this->options;

        $body = [];
        $body['auto_date_histogram'] = $aggBody;
        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
