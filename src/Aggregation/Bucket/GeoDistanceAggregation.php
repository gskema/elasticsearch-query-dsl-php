<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\GeoPointInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-geodistance-aggregation.html
 * @see GeoDistanceAggregationTest
 *
 * @options 'unit' => 'km',
 *          'distance_type' => 'plane',
 *          'keyed' => true,
 */
class GeoDistanceAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /** @var string */
    protected $field;

    /** @var GeoPointInterface */
    protected $origin;

    /**
     * ['from' => 10, 'to' => 99, 'key' => 'custom_bucket_key'],
     *
     * @var array[]
     */
    protected $ranges;

    public function __construct(string $field, GeoPointInterface $origin, array $ranges, array $options = [])
    {
        $this->field = $field;
        $this->origin = $origin;
        $this->ranges = $ranges;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['geo_distance'] = [
            'field' => $this->field,
            'origin' => $this->origin->jsonSerialize(),
            'ranges' => $this->ranges,
        ];
        $body['geo_distance'] += $this->options;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
