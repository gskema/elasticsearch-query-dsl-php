<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use stdClass;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use function Gskema\ElasticSearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-reverse-nested-aggregation.html
 * @see ReverseNestedAggregationTest
 */
class ReverseNestedAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;

    public function __construct(protected ?string $path = null)
    {
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
        if (null !== $this->path) {
            $body['reverse_nested']['path'] = $this->path;
        } else {
            $body['reverse_nested'] = new stdClass();
        }

        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
