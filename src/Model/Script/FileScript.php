<?php

namespace Gskema\ElasticSearchQueryDSL\Model\Script;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/modules-scripting-using.html#modules-scripting-file-scripts
 * @see FileScriptTest
 */
class FileScript implements ScriptInterface
{
    /** @var string */
    protected $file;

    /** @var array */
    protected $params;

    /** @var string|null */
    protected $lang;

    public function __construct(string $file, array $params = [], string $lang = null)
    {
        $this->file = $file;
        $this->params = $params;
        $this->lang = $lang;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
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
