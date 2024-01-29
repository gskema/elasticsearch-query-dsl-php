<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\HasAggsTrait;
use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticsearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticsearchQueryDSL\Options;
use InvalidArgumentException;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-datehistogram-aggregation.html
 * @see DateHistogramAggregationTest
 */
#[Options([
    'format' => 'yyyy-MM-dd',
    'time_zone' => '-01:00',
    'offset' => '+6h',
    'keyed' => true,
    'order' => ['_key' => 'desc'],
    'min_doc_count' => 1,
    'missing' => '2000/01/01',
    'extended_bounds' => ['min' => '2000/01/01', 'max' => '2030/01/01'],
])]
class DateHistogramAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /**
     * @param array<string, mixed> $options
     */
    protected function __construct(
        protected ?string $field,
        protected ?ScriptInterface $script,
        // 'year', 'quarter', 'month', 'week', 'day', 'hour', 'minute', 'second'
        // '?d', '?h', '?m, '?s', '?ms', '?micros', '?nanos'
        protected string $interval,
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
    public static function fromField(
        string $field,
        string $interval,
        array $options = [],
        ?InlineScript $valueScript = null,
    ): static {
        return new static($field, $valueScript, $interval, $options);
    }

    /**
     * @param array<string, mixed> $options
     */
    public static function fromScript(
        ScriptInterface $script,
        string $interval,
        array $options = [],
    ): static {
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
        $body['date_histogram'] = $aggBody;
        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
