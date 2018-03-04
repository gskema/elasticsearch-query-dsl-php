<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-iprange-aggregation.html
 * @see IpRangeAggregationTest
 *
 * @options 'keyed' => true,
 */
class IpRangeAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /** @var string */
    protected $field;

    /**
     * ['from' => '10.0.0.5', 'to' => '10.0.0.5', 'key' => 'custom_bucket_key'],
     * ['mask' => '10.0.0.0/25', 'key' => 'custom_bucket_key'],
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

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['ip_ranges']['field'] = $this->field;
        $body['ip_ranges']['ranges'] = $this->ranges;
        $body['ip_ranges'] += $this->options;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
