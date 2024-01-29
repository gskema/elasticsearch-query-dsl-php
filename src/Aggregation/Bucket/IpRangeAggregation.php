<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\HasAggsTrait;
use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-iprange-aggregation.html
 * @see IpRangeAggregationTest
 */
#[Options([
    'keyed' => true,
])]
class IpRangeAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        /**
         * @var array<string, string>[]
         * ['from' => '10.0.0.5', 'to' => '10.0.0.5', 'key' => 'custom_bucket_key'],
         * ['mask' => '10.0.0.0/25', 'key' => 'custom_bucket_key'],
         */
        protected array $ranges,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->aggs = array_clone($this->aggs);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['ip_ranges']['field'] = $this->field;
        $body['ip_ranges']['ranges'] = $this->ranges;
        $body['ip_ranges'] += $this->options;

        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
