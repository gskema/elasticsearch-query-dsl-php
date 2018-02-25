<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-geohashgrid-aggregation.html
 * @see GeoHashGridAggregationTest
 *
 * @options 'precision' => 3,
 *          'size' => 10000,
 *          'shard_size' => 10,
 */
class GeoHashGridAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /** @var string */
    protected $field;

    public function __construct(string $field, array $options = [])
    {
        $this->field = $field;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body['geohash_grid']['field'] = $this->field;
        $body['geohash_grid'] += $this->options;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
