<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-script-query.html
 * @see ScriptMatcherTest
 */
#[Options([
    '_name' => '?',
])]
class ScriptMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected ScriptInterface $script,
    ) {
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
            'script' => $body,
        ];
    }
}
