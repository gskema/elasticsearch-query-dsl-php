<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\SourceFilter\SourceFilterInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-source-filtering.html
 * @see HasSourceFieldsTraitTest
 */
trait HasSourceFieldsTrait
{
    /** @var SourceFilterInterface|string[]|null */
    protected SourceFilterInterface|array|null $sourceFields = null;

    /**
     * @return SourceFilterInterface|string[]|null
     */
    public function getSourceFields(): SourceFilterInterface|array|null
    {
        return $this->sourceFields;
    }

    /**
     * @param SourceFilterInterface|string[]|null $sourceFields
     */
    public function setSourceFields(SourceFilterInterface|array|null $sourceFields): static
    {
        $this->sourceFields = $sourceFields;
        return $this;
    }

    protected function jsonSerializeSourceFields(): mixed
    {
        return is_array($this->sourceFields) ? $this->sourceFields : $this->sourceFields?->jsonSerialize();
    }
}
