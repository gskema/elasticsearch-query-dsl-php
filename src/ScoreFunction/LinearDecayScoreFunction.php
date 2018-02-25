<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-function-score-query.html#_supported_decay_functions
 * @see LinearDecayScoreFunctionTest
 *
 * @options 'offset' => 0,
 *          'decay' => 0.5,
 *          'multi_value_mode' => 'min', 'max', 'avg', 'sum',
 */
class LinearDecayScoreFunction extends AbstractDecayScoreFunction
{
    /**
     * @inheritdoc
     */
    protected function getFunctionType(): string
    {
        return 'linear';
    }
}
