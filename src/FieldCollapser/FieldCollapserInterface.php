<?php

namespace Gskema\ElasticSearchQueryDSL\FieldCollapser;

use JsonSerializable;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-collapse.html
 */
interface FieldCollapserInterface extends JsonSerializable
{
}
