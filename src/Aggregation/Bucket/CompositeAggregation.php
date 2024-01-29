<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\HasAggsTrait;
use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-composite-aggregation.html
 * @see CompositeAggregationTest
 */
#[Options([
    'size' => 10,
    'after' => ['date' => 1494288000000, 'product' => 'mad max'],
])]
class CompositeAggregation implements BucketAggregationInterface
{
    use HasAggsTrait;
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        /** @var array<string, BucketAggregationInterface>[] */
        protected array $sources,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone(): void
    {
        $this->sources = array_clone($this->sources);
        $this->aggs = array_clone($this->aggs);
    }

    public function jsonSerialize(): mixed
    {
        $aggBody = $this->options;
        $aggBody['sources'] = $this->sources;

        $body = ['composite' => $aggBody];
        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
