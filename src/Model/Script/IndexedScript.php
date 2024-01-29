<?php

namespace Gskema\ElasticsearchQueryDSL\Model\Script;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/modules-scripting-using.html#modules-scripting-stored-scripts
 * @see IndexedScriptTest
 */
class IndexedScript implements ScriptInterface
{
    public function __construct(
        protected string $id,
        /** @var array<string, mixed> */
        protected array $params = [],
    ) {
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['id'] = $this->id;
        if (!empty($this->params)) {
            $body['params'] = $this->params;
        }

        return $body;
    }
}
