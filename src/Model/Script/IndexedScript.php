<?php

namespace Gskema\ElasticSearchQueryDSL\Model\Script;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/modules-scripting-using.html#modules-scripting-stored-scripts
 * @see IndexedScriptTest
 */
class IndexedScript implements ScriptInterface
{
    /** @var string */
    protected $id;

    /** @var array */
    protected $params;

    public function __construct(string $id, array $params = [])
    {
        $this->id = $id;
        $this->params = $params;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body['id'] = $this->id;
        if (!empty($this->params)) {
            $body['params'] = $this->params;
        }

        return $body;
    }
}
