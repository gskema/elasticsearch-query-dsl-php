<?php

namespace Gskema\ElasticSearchQueryDSL\Model\Script;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/modules-scripting-using.html#modules-scripting-file-scripts
 * @see FileScriptTest
 */
class FileScript implements ScriptInterface
{
    public function __construct(
        protected string $file,
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
        $body['file'] = $this->file;
        if (null !== $this->lang) {
            $body['lang'] = $this->lang;
        }
        if (!empty($this->params)) {
            $body['params'] = $this->params;
        }

        return $body;
    }
}
