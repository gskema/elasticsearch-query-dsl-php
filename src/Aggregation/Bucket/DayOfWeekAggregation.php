<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use Gskema\ElasticSearchQueryDSL\Options;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use function Gskema\ElasticSearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-datehistogram-aggregation.html#_using_a_script_to_aggregate_by_day_of_the_week
 * @see DayOfWeekAggregationTest
 */
#[Options([
    'size' => 5,
    'shard_size' => 5,
    'show_term_doc_count_error' => true,
    'order' => ['_count' => 'asc'],
    'min_doc_count' => 1,
    'shard_min_doc_count' => 0,
    'include' => '.*sport.*', // ['mazda', 'toyota'], ['partition' => 0, 'num_partitions' => 20],
    'exclude' => 'water_.*', // ['mazda', 'toyota'], ['partition' => 0, 'num_partitions' => 20],
    'collect_mode' => 'breadth_first', // 'depth_first',
    'execution_hint' => 'map', // 'global_ordinals', 'global_ordinals_hash', 'global_ordinals_low_cardinality',
    'missing' => 'N/A',
])]
class DayOfWeekAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
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
        $script = new InlineScript('doc[\'' . $this->field . '\'].value.dayOfWeekEnum.value', [], 'painless');

        $body = [];
        $body['terms']['script'] = $script->jsonSerialize();
        $body['terms'] += $this->options;

        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
