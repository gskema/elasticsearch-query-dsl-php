<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\FieldCollapser\FieldCollapserInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-collapse.html
 * @see HasFieldCollapserTraitTest
 */
trait HasFieldCollapserTrait
{
    protected ?FieldCollapserInterface $fieldCollapser = null;

    public function getFieldCollapser(): ?FieldCollapserInterface
    {
        return $this->fieldCollapser;
    }

    public function setFieldCollapser(?FieldCollapserInterface $fieldCollapser): static
    {
        $this->fieldCollapser = $fieldCollapser;
        return $this;
    }
}
