<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\SearchRequest\TopHitsRequest;
use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-top-hits-aggregation.html
 * @see TopHitsAggregationTest
 */
class TopHitsAggregation implements MetricAggregationInterface
{
    /** @var TopHitsRequest|null */
    protected $request;

    public function __construct(TopHitsRequest $request = null)
    {
        $this->request = $request;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        if (null !== $this->request) {
            $body = $this->request->jsonSerialize();
        } else {
            $body = new stdClass();
        }

        return [
            'top_hits' => $body,
        ];
    }
}
