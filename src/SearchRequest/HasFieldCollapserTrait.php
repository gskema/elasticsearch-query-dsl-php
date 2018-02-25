<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\FieldCollapser\FieldCollapserInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-collapse.html
 */
trait HasFieldCollapserTrait
{
    /** @var FieldCollapserInterface|null */
    protected $fieldCollapser;

    /**
     * @return FieldCollapserInterface|null
     */
    public function getFieldCollapser()
    {
        return $this->fieldCollapser;
    }

    /**
     * @param FieldCollapserInterface|null $fieldCollapser
     *
     * @return $this
     */
    public function setFieldCollapser(FieldCollapserInterface $fieldCollapser = null)
    {
        $this->fieldCollapser = $fieldCollapser;

        return $this;
    }
}
