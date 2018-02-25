<?php

namespace Gskema\ElasticSearchQueryDSL\SourceFilter;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-source-filtering.html
 */
class DisabledSourceFilter implements SourceFilterInterface
{
    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return false;
    }
}
