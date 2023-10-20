<?php

namespace Gskema\ElasticSearchQueryDSL\Rescorer;

use JsonSerializable;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-rescore.html
 */
interface RescorerInterface extends JsonSerializable
{
}
