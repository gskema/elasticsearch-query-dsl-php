<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-script-fields.html
 */
trait HasScriptFieldsTrait
{
    /** @var ScriptInterface[] */
    protected $scriptFields = [];

    /**
     * @return ScriptInterface[]
     */
    public function getScriptFields(): array
    {
        return $this->scriptFields;
    }

    /**
     * @param string $field
     *
     * @return ScriptInterface|null
     */
    public function getScriptField(string $field)
    {
        return $this->scriptFields[$field] ?? null;
    }

    /**
     * @param ScriptInterface[] $scriptsByField
     *
     * @return $this
     */
    public function setScriptFields(array $scriptsByField)
    {
        $this->scriptFields = $scriptsByField;

        return $this;
    }

    /**
     * @param string          $field
     * @param ScriptInterface $script
     *
     * @return $this
     */
    public function setScriptField(string $field, ScriptInterface $script)
    {
        $this->scriptFields[$field] = $script;

        return $this;
    }

    /**
     * @param string $field
     *
     * @return $this
     */
    public function removeScriptField(string $field)
    {
        unset($this->scriptFields[$field]);

        return $this;
    }
}
