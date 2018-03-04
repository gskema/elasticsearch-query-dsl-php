<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-reverse-nested-aggregation.html
 * @see ReverseNestedAggregationTest
 */
class ReverseNestedAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    /** @var string|null */
    protected $path;

    public function __construct(string $path = null)
    {
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        if (null !== $this->path) {
            $body['reverse_nested']['path'] = $this->path;
        } else {
            $body['reverse_nested'] = new stdClass();
        }

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
