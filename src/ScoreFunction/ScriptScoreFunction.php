<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-function-score-query.html#function-script-score
 * @see ScriptScoreFunctionTest
 *
 * @options 'boost_mode' => 'replace'
 */
class ScriptScoreFunction implements ScoreFunctionInterface
{
    use HasOptionsTrait;

    /** @var ScriptInterface */
    protected $script;

    public function __construct(ScriptInterface $script, array $options = [])
    {
        $this->script = $script;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['script'] = $this->script->jsonSerialize();
        $body += $this->options;

        return [
            'script_score' => $body,
        ];
    }
}
