<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Matrix;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-matrix-stats-aggregation.html
 * @see MatrixStatsAggregationTest
 *
 * @options 'mode' => 'avg', 'min', 'max', 'sum', 'median',
 *          'missing' => ['field1' => 50, 'field2' => 100],
 */
class MatrixStatsAggregation implements MatrixAggregationInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field1;

    /** @var string */
    protected $field2;

    public function __construct(string $field1, string $field2, array $options = [])
    {
        $this->field1 = $field1;
        $this->field2 = $field2;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body['fields'] = [$this->field1, $this->field2];
        $body += $this->options;

        return [
            'matrix_stats' => $body,
        ];
    }
}
