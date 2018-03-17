<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\SourceFilter\SourceFilterInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-source-filtering.html
 * @see HasSourceFieldsTraitTest
 */
trait HasSourceFieldsTrait
{
    /** @var SourceFilterInterface|null */
    protected $sourceFields;

    /**
     * @return SourceFilterInterface|null
     */
    public function getSourceFields()
    {
        return $this->sourceFields;
    }

    /**
     * @param SourceFilterInterface|null $sourceFilter
     *
     * @return $this
     */
    public function setSourceFields(SourceFilterInterface $sourceFilter = null)
    {
        $this->sourceFields = $sourceFilter;

        return $this;
    }
}
