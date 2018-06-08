<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-diversified-sampler-aggregation.html
 * @see DiversifiedSamplerAggregationTest
 *
 * @options 'shard_size' => 100,
 *          'max_docs_per_value' => 1,
 *          'execution_hint' => 'global_ordinals', 'map', 'bytes_hash'
 */
class DiversifiedSamplerAggregation implements BucketAggregationInterface
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

    public function __clone()
    {
        $this->aggs = array_clone($this->aggs);
    }

    public static function fromField(string $field, array $options = []): DiversifiedSamplerAggregation
    {
        return new static(['field' => $field], $options);
    }

    public static function fromScript(ScriptInterface $script, array $options = []): DiversifiedSamplerAggregation
    {
        return new static(['script' => $script->jsonSerialize()], $options);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['diversified_sampler'] = $this->body;
        $body['diversified_sampler'] += $this->options;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
