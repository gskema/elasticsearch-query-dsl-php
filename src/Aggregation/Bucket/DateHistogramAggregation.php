<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-datehistogram-aggregation.html
 * @see DateHistogramAggregationTest
 *
 * @options 'format' => 'yyyy-MM-dd',
 *          'time_zone' => '-01:00'
 *          'offset' => '+6h'
 *          'keyed' => true,
 *          'order' => ['_key': 'desc'],
 *          'min_doc_count' => 1,
 *          'missing' => '2000/01/01',
 *          'extended_bounds' => ['min' => '2000/01/01', 'max' => '2030/01/01'],
 */
class DateHistogramAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /** @var array */
    protected $body;

    /**
     * 'year', 'quarter', 'month', 'week', 'day', 'hour', 'minute', 'second'
     * '?d', '?h', '?m, '?s', '?ms', '?micros', '?nanos'
     *
     * @var string
     */
    protected $interval;

    protected function __construct(array $body, string $interval, array $options = [])
    {
        $this->body = $body;
        $this->interval = $interval;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->aggs = array_clone($this->aggs);
    }

    public static function fromField(
        string $field,
        string $interval,
        array $options = [],
        InlineScript $valueScript = null
    ): DateHistogramAggregation {
        $body = [];
        $body['field'] = $field;
        if (null !== $valueScript) {
            $body['script'] = $valueScript->jsonSerialize();
        }

        return new static($body, $interval, $options);
    }

    public static function fromScript(
        ScriptInterface $script,
        string $interval,
        array $options = []
    ): DateHistogramAggregation {
        return new static(['script' => $script->jsonSerialize()], $interval, $options);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['date_histogram'] = $this->body;
        $body['date_histogram']['interval'] = $this->interval;
        $body['date_histogram'] += $this->options;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
