<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\GeoPointInterface;
use Gskema\ElasticSearchQueryDSL\Options;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use function Gskema\ElasticSearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-geodistance-aggregation.html
 * @see GeoDistanceAggregationTest
 */
#[Options([
    'unit' => 'km',
    'distance_type' => 'plane', // 'arc',
    'keyed' => true,
])]
class GeoDistanceAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        protected GeoPointInterface $origin,
        /** @var array<string, mixed>[] ['from' => 10, 'to' => 99, 'key' => 'custom_bucket_key'], */
        protected array $ranges,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->origin = clone $this->origin;
        $this->aggs = array_clone($this->aggs);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['geo_distance'] = [
            'field' => $this->field,
            'origin' => $this->origin->jsonSerialize(),
            'ranges' => $this->ranges,
        ];
        $body['geo_distance'] += $this->options;

        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
