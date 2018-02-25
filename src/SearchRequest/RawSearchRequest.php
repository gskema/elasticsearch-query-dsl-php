<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-body.html
 */
class RawSearchRequest implements SearchRequestInterface
{
    /** @var array */
    protected $body;

    public function __construct(array $body)
    {
        $this->body = $body;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->body ?: new stdClass();
    }
}
