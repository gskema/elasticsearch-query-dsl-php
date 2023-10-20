<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Matrix;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-matrix-stats-aggregation.html
 * @see MatrixStatsAggregationTest
 */
#[Options([
    'mode' => 'avg', // 'min', 'max', 'sum', 'median',
    'missing' => ['field1' => 50, 'field2' => 100],
])]
class MatrixStatsAggregation implements MatrixAggregationInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field1,
        protected string $field2,
        array $options = [],
    ) {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['fields'] = [$this->field1, $this->field2];
        $body += $this->options;

        return [
            'matrix_stats' => $body,
        ];
    }
}
