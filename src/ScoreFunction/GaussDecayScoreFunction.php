<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-function-score-query.html#_supported_decay_functions
 * @see GaussDecayScoreFunctionTest
 */
#[Options([
    'offset' => 0,
    'decay' => 0.5,
    'multi_value_mode' => 'min', // 'max', 'avg', 'sum',
])]
class GaussDecayScoreFunction extends AbstractDecayScoreFunction
{
    /**
     * @inheritDoc
     */
    protected function getFunctionType(): string
    {
        return 'gauss';
    }
}
