<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-function-score-query.html#function-random
 * @see RandomScoreFunctionTest
 */
class RandomScoreFunction implements ScoreFunctionInterface
{
    public function __construct(
        protected ?int $seed = null,
        protected ?string $field = null,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        if (null !== $this->seed) {
            $body['seed'] = $this->seed;
        }
        if (null !== $this->field) {
            $body['field'] = $this->field;
        }

        return [
            'random_score' => $body ?: new stdClass(),
        ];
    }
}
