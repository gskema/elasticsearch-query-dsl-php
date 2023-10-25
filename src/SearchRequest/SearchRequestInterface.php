<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use JsonSerializable;

/**
 * To be used when creating custom SearchRequest classes (e.g. with a SearchRequest class that requires a stat group).
 * Can be used to type-hint when an ElasticSearch client search method expects an instance of SearchRequestInterface.
 * TopHitsRequest and InnerHitsRequest are not SearchRequestInterface because they have custom properties.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-body.html
 */
interface SearchRequestInterface extends JsonSerializable
{
    /**
     * Returns a list of URL parameters to be sent with request.
     * @see SearchRequest - #[Parameters] attribute
     * @return array<string, mixed>
     */
    public function getParameters(): array;
}
