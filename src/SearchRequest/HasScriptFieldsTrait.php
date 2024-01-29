<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-script-fields.html
 * @see HasScriptFieldsTraitTest
 */
trait HasScriptFieldsTrait
{
    /** @var ScriptInterface[] */
    protected array $scriptFields = [];

    /**
     * @return ScriptInterface[]
     */
    public function getScriptFields(): array
    {
        return $this->scriptFields;
    }

    public function getScriptField(string $field): ?ScriptInterface
    {
        return $this->scriptFields[$field] ?? null;
    }

    /**
     * @param ScriptInterface[] $scriptsByField
     */
    public function setScriptFields(array $scriptsByField): static
    {
        $this->scriptFields = $scriptsByField;
        return $this;
    }

    public function setScriptField(string $field, ScriptInterface $script): static
    {
        $this->scriptFields[$field] = $script;
        return $this;
    }

    public function removeScriptField(string $field): static
    {
        unset($this->scriptFields[$field]);
        return $this;
    }
}
