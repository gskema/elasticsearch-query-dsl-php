<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-datehistogram-aggregation.html#_use_of_a_script_to_aggregate_by_day_of_the_week
 * @see DayOfWeekAggregationTest
 *
 * @options 'size' => 5,
 *          'shard_size' => 5,
 *          'show_term_doc_count_error' => true,
 *          'order' => ['_count' => 'asc'],
 *          'min_doc_count' => 1,
 *          'shard_min_doc_count' => 0,
 *          'include' => '.*sport.*', ['mazda', 'toyota'], ['partition' => 0, 'num_partitions' => 20],
 *          'exclude' => 'water_.*', ['mazda', 'toyota'], ['partition' => 0, 'num_partitions' => 20],
 *          'collect_mode' => 'breadth_first', 'depth_first',
 *          'execution_hint' => 'map', 'global_ordinals', 'global_ordinals_hash', 'global_ordinals_low_cardinality',
 *          'missing' => 'N/A',
 */
class DayOfWeekAggregation implements BucketAggregationInterface
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
        $script = new InlineScript('doc[\''.$this->field.'\'].date.dayOfWeek', [], 'expression');

        $body['terms']['script'] = $script->jsonSerialize();
        $body['terms'] += $this->options;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
