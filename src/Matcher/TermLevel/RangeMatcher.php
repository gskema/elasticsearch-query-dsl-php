<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MultiTermMatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-range-query.html
 * @see RangeMatcherTest
 *
 * @options 'boost' => 2.0,
 *          'format': 'dd/MM/yyyy||yyyy'
 *          'time_zone' => '+01:00',
 *          '_name' => '?',
 */
class RangeMatcher implements MultiTermMatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /**
     * 'gt' => 5,
     * 'gte' => 5,
     * 'lt' => 5,
     * 'lte' => 5,
     *
     * @var array
     */
    protected $range;

    public function __construct(string $field, array $range, array $options = [])
    {
        $this->field = $field;
        $this->range = $range;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = $this->range;
        $body += $this->options;

        return [
            'range' => [
                $this->field => $body,
            ],
        ];
    }
}
