<?php

namespace Gskema\ElasticsearchQueryDSL\Model\Script;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/modules-scripting-using.html
 * @see InlineScriptTest
 */
class InlineScript implements ScriptInterface
{
    public function __construct(
        protected string $source,
        /** @var array<string, mixed> */
        protected array $params = [],
        protected ?string $lang = null,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        if (null !== $this->lang) {
            $body['lang'] = $this->lang;
        }
        $body['source'] = $this->source;
        if (!empty($this->params)) {
            $body['params'] = $this->params;
        }

        return 1 === count($body) ? $body['source'] : $body;
    }
}
