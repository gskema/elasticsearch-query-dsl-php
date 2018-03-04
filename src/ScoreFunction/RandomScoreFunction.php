<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-function-score-query.html#function-random
 * @see RandomScoreFunctionTest
 */
class RandomScoreFunction implements ScoreFunctionInterface
{
    /** @var int|null */
    protected $seed;

    public function __construct(int $seed = null)
    {
        $this->seed = $seed;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        if (null !== $this->seed) {
            $body = [];
            $body['seed'] = $this->seed;
        } else {
            $body = new stdClass();
        }

        return [
            'random_score' => $body,
        ];
    }
}
