<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-function-score-query.html#function-weight
 * @see WeightScoreFunctionTest
 */
class WeightScoreFunction implements ScoreFunctionInterface
{
    protected float $weight;

    public function __construct(float $weight)
    {
        $this->weight = $weight;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'weight' => $this->weight,
        ];
    }
}
