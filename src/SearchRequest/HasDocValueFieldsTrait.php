<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-docvalue-fields.html
 * @see HasDocValueFieldsTraitTest
 */
trait HasDocValueFieldsTrait
{
    /** @var string[] */
    protected array $docValueFields = [];

    /**
     * @return string[]
     */
    public function getDocValueFields(): array
    {
        return $this->docValueFields;
    }

    /**
     * @param string[] $docValueFields
     */
    public function setDocValueFields(array $docValueFields): static
    {
        $this->docValueFields = $docValueFields;
        return $this;
    }
}
