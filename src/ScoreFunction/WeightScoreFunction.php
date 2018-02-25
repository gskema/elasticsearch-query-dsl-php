<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-function-score-query.html#function-weight
 * @see WeightScoreFunctionTest
 */
class WeightScoreFunction implements ScoreFunctionInterface
{
    /** @var float */
    protected $weight;

    public function __construct(float $weight)
    {
        $this->weight = $weight;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'weight' => $this->weight,
        ];
    }
}
