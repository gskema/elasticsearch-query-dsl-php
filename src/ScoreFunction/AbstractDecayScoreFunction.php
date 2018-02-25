<?php

namespace Gskema\ElasticSearchQueryDSL\ScoreFunction;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-function-score-query.html#_supported_decay_functions
 *
 * @options 'offset' => 0,
 *          'decay' => 0.5,
 *          'multi_value_mode' => 'min', 'max', 'avg', 'sum',
 */
abstract class AbstractDecayScoreFunction implements ScoreFunctionInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string|float|int */
    protected $origin;

    /** @var string|float|int */
    protected $scale;

    public function __construct(string $field, $origin, $scale, array $options = [])
    {
        $this->field = $field;
        $this->origin = $origin;
        $this->scale = $scale;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [
            'field' => $this->field,
            'origin' => $this->origin,
            'scale' => $this->scale,
        ];
        $body += $this->options;

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
