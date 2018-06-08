<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-script-query.html
 * @see ScriptMatcherTest
 *
 * @options '_name' => '?',
 */
class ScriptMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var ScriptInterface */
    protected $script;

    public function __construct(ScriptInterface $script)
    {
        $this->script = $script;
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
        $body = [];
        $body['script'] = $this->script->jsonSerialize();
        $body += $this->options;

        return [
            'script' => $body,
        ];
    }
}
