<?php

namespace Gskema\ElasticsearchQueryDSL\SourceFilter;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-source-filtering.html
 * @see DisabledSourceFilterTest
 */
class DisabledSourceFilter implements SourceFilterInterface
{
    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return false;
    }
}
