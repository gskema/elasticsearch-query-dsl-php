<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\PipelineAggregationInterface;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-pipeline-bucket-script-aggregation.html
 * @see BucketScriptAggregationTest
 *
 * @options 'gap_policy' => 'skip', 'insert_zeros',
 *          'format' => ?,
 */
class BucketScriptAggregation implements PipelineAggregationInterface
{
    use HasOptionsTrait;

    /** @var string[] */
    protected $bucketsPath;

    /** @var ScriptInterface */
    protected $script;

    /**
     * @param string[]        $bucketsPathByVar
     * @param ScriptInterface $script
     * @param array           $options
     */
    public function __construct(array $bucketsPathByVar, ScriptInterface $script, array $options = [])
    {
        $this->bucketsPath = $bucketsPathByVar;
        $this->script = $script;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->script = clone $this->script;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [
            'buckets_path' => $this->bucketsPath,
            'script' => $this->script->jsonSerialize(),
        ];
        $body += $this->options;

        return [
            'bucket_script' => $body,
        ];
    }
}
