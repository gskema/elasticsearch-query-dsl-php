<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-stored-fields.html
 * @see HasStoredFieldsTraitTest
 */
trait HasStoredFieldsTrait
{
    /** @var string[]|string|null */
    protected $storedFields;

    /**
     * @return string[]|string|null
     */
    public function getStoredFields()
    {
        return $this->storedFields;
    }

    /**
     * @param string[]|string|null $storedFields
     *
     * @return $this
     */
    public function setStoredFields($storedFields = null)
    {
        $this->storedFields = $storedFields;

        return $this;
    }
}
