<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-docvalue-fields.html
 */
trait HasDocValueFieldsTrait
{
    /** @var string[] */
    protected $docValueFields = [];

    /**
     * @return string[]
     */
    public function getDocValueFields(): array
    {
        return $this->docValueFields;
    }

    /**
     * @param string[] $docValueFields
     *
     * @return $this
     */
    public function setDocValueFields(array $docValueFields)
    {
        $this->docValueFields = $docValueFields;

        return $this;
    }
}
