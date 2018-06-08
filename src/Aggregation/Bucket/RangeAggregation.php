<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-range-aggregation.html
 * @see RangeAggregationTest
 *
 * @options 'keyed' => true,
 */
class RangeAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /** @var array */
    protected $body;

    /**
     * ['from' => 5, 'to' => 5, 'key' => 'custom_bucket_key'],
     *
     * @var array[]
     */
    protected $ranges;

    protected function __construct(array $body, array $ranges, array $options = [])
    {
        $this->body = $body;
        $this->ranges = $ranges;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->aggs = array_clone($this->aggs);
    }

    public static function fromField(
        string $field,
        array $ranges,
        array $options = [],
        InlineScript $valueScript = null
    ): RangeAggregation {
        $body = [];
        $body['field'] = $field;
        if (null !== $valueScript) {
            $body['script'] = $valueScript->jsonSerialize();
        }

        return new static($body, $ranges, $options);
    }

    public static function fromScript(ScriptInterface $script, array $ranges, array $options = []): RangeAggregation
    {
        return new static(['script' => $script->jsonSerialize()], $ranges, $options);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['range'] = $this->body;
        $body['range']['ranges'] = $this->ranges;
        $body['range'] += $this->options;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
