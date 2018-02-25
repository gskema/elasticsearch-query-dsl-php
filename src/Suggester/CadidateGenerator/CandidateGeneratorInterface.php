<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester\CandidateGenerator;

use JsonSerializable;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-suggesters-phrase.html#_candidate_generators
 */
interface CandidateGeneratorInterface extends JsonSerializable
{
}
