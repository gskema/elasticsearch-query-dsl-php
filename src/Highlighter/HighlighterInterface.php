<?php

namespace Gskema\ElasticSearchQueryDSL\Highlighter;

use JsonSerializable;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-highlighting.html
 */
interface HighlighterInterface extends JsonSerializable
{
}
