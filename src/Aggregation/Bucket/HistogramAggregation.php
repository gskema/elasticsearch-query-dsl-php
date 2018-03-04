<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-histogram-aggregation.html
 * @see HistogramAggregationTest
 *
 * @options 'min_doc_count' => 1,
 *          'extended_bounds' => ['min' => 0, 'max' => 500],
 *          'order' => ['_key' => 'desc'],
 *          'offset' => 5,
 *          'keyed' => true,
 *          'missing' => 0,
 */
class HistogramAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /** @var array */
    protected $body;

    /** @var float */
    protected $interval;

    protected function __construct(array $body, float $interval, array $options = [])
    {
        $this->body = $body;
        $this->interval = $interval;
        $this->options = $options;
    }

    public static function fromField(
        string $field,
        float $interval,
        array $options = [],
        InlineScript $valueScript = null
    ): HistogramAggregation {
        $body = [];
        $body['field'] = $field;
        if (null !== $valueScript) {
            $body['script'] = $valueScript->jsonSerialize();
        }

        return new static($body, $interval, $options);
    }

    public static function fromScript(
        ScriptInterface $script,
        float $interval,
        array $options = []
    ): HistogramAggregation {
        return new static(['script' => $script->jsonSerialize()], $interval, $options);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['histogram'] = $this->body;
        $body['histogram']['interval'] = $this->interval;
        $body['histogram'] += $this->options;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
