<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-daterange-aggregation.html
 * @see DateRangeAggregationTest
 *
 * @options 'format' => 'MM-yyy'
 *          'time_zone' => 'CET',
 *          'keyed' => true,
 */
class DateRangeAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /** @var string */
    protected $field;

    /**
     * ['from' => '2016/02/01', 'to' => 'now/d', 'key' => 'custom_bucket_key'],
     *
     * @var array[]
     */
    protected $ranges;

    public function __construct(string $field, array $ranges, array $options = [])
    {
        $this->field = $field;
        $this->ranges = $ranges;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->aggs = array_clone($this->aggs);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['date_range']['field'] = $this->field;
        $body['date_range']['ranges'] = $this->ranges;
        $body['date_range'] += $this->options;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
