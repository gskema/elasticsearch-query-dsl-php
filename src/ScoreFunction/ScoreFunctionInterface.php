<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use JsonSerializable;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-function-score-query.html#score-functions
 */
interface ScoreFunctionInterface extends JsonSerializable
{
}
