<?php

namespace Gskema\ElasticSearchQueryDSL\Model\Script;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/modules-scripting-using.html
 * @see InlineScriptTest
 */
class InlineScript implements ScriptInterface
{
    /** @var string */
    protected $source;

    /** @var array */
    protected $params;

    /** @var string */
    protected $lang;

    public function __construct(string $source, array $params = [], string $lang = null)
    {
        $this->source = $source;
        $this->params = $params;
        $this->lang = $lang;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        if (null !== $this->lang) {
            $body['lang'] = $this->lang;
        }
        $body['source'] = $this->source;
        if (!empty($this->params)) {
            $body['params'] = $this->params;
        }

        $body = 1 === count($body) ? $body['source'] : $body;

        return $body;
    }
}
