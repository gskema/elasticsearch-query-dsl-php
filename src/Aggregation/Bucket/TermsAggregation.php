<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-terms-aggregation.html
 * @see TermsAggregationTest
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
class TermsAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /** @var array */
    protected $body;

    protected function __construct(array $body, array $options = [])
    {
        $this->body = $body;
        $this->options = $options;
    }

    public static function fromField(
        string $field,
        array $options = [],
        ScriptInterface $valueScript = null
    ): TermsAggregation {
        $body['field'] = $field;
        if (null !== $valueScript) {
            $body['script'] = $valueScript->jsonSerialize();
        }

        return new static($body, $options);
    }

    public static function fromScript(ScriptInterface $script, array $options = []): TermsAggregation
    {
        return new static(['script' => $script->jsonSerialize()], $options);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['terms'] = $this->body;
        $body['terms'] += $this->options;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
