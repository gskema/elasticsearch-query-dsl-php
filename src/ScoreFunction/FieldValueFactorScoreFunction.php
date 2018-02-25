<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-function-score-query.html#function-field-value-factor
 * @see FieldValueFactorScoreFunctionTest
 *
 * @options 'factor' => 1,
 *          'modifier' => 'none', 'log', 'log1p', 'log2p', 'ln', 'ln1p', 'ln2p', 'square', 'sqrt', 'reciprocal',
 *          'missing' => 0,
 */
class FieldValueFactorScoreFunction implements ScoreFunctionInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    public function __construct(string $field, array $options = [])
    {
        $this->field = $field;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body['field'] = $this->field;
        $body += $this->options;

        return [
            'field_value_factor' => $body,
        ];
    }
}
