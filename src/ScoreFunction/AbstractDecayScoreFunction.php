<?php

namespace Gskema\ElasticsearchQueryDSL\ScoreFunction;

use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-function-score-query.html#_supported_decay_functions
 */
#[Options([
    'offset' => 0,
    'decay' => 0.5,
    'multi_value_mode' => 'min', // 'max', 'avg', 'sum',
])]
abstract class AbstractDecayScoreFunction implements ScoreFunctionInterface
{
    public function __construct(
        protected string $field,
        protected string|float|int $origin,
        protected string|float|int $scale,
        protected string|float|int|null $offset = null,
        protected string|float|int|null $decay = null,
        protected ?string $multiValueMode = null, // 'min', 'max', 'avg', 'sum'
    ) {
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [
            'field' => $this->field,
            'origin' => $this->origin,
            'scale' => $this->scale,
        ];
        if (null !== $this->offset) {
            $body['offset'] = $this->offset;
        }
        if (null !== $this->decay) {
            $body['decay'] = $this->decay;
        }
        if (null !== $this->multiValueMode) {
            $body['multi_value_mode'] = $this->multiValueMode;
        }

        return [
            $this->getFunctionType() => $body,
        ];
    }

    /**
     * Returns decay function type, e.g. exp, gauss or linear.
     *
     * @return string
     */
    abstract protected function getFunctionType(): string;
}
