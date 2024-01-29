<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-stored-fields.html
 * @see HasStoredFieldsTraitTest
 */
trait HasStoredFieldsTrait
{
    /** @var string[]|string|null */
    protected array|string|null $storedFields = null;

    /**
     * @return string[]|string|null
     */
    public function getStoredFields(): array|string|null
    {
        return $this->storedFields;
    }

    /**
     * @param string[]|string|null $storedFields
     */
    public function setStoredFields(array|string|null $storedFields): static
    {
        $this->storedFields = $storedFields;
        return $this;
    }
}
