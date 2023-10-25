<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\HasParametersTrait;
use Gskema\ElasticSearchQueryDSL\RawFragment;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-body.html
 * @see RawSearchRequestTest
 */
class RawSearchRequest extends RawFragment implements SearchRequestInterface
{
    use HasParametersTrait;
}
