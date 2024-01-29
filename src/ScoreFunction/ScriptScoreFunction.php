<?php

namespace Gskema\ElasticsearchQueryDSL\ScoreFunction;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-function-score-query.html#function-script-score
 * @see ScriptScoreFunctionTest
 */
#[Options([
    'boost_mode' => 'replace'
])]
class ScriptScoreFunction implements ScoreFunctionInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected ScriptInterface $script,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->script = clone $this->script;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['script'] = $this->script->jsonSerialize();
        $body += $this->options;

        return [
            'script_score' => $body,
        ];
    }
}
