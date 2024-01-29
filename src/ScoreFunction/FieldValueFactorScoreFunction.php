<?php

namespace Gskema\ElasticsearchQueryDSL\ScoreFunction;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-function-score-query.html#function-field-value-factor
 * @see FieldValueFactorScoreFunctionTest
 */
class FieldValueFactorScoreFunction implements ScoreFunctionInterface
{
    public function __construct(
        protected string $field,
        protected ?float $factor = null,
        protected ?string $modifier = null, // none, log, log1p, log2p, ln, ln1p, ln2p, square, sqrt, reciprocal
        protected float|int|null $missing = null,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['field'] = $this->field;
        if (null !== $this->factor) {
            $body['factor'] = $this->factor;
        }
        if (null !== $this->modifier) {
            $body['modifier'] = $this->modifier;
        }
        if (null !== $this->missing) {
            $body['missing'] = $this->missing;
        }

        return [
            'field_value_factor' => $body,
        ];
    }
}
