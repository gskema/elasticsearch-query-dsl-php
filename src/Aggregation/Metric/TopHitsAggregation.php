<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\SearchRequest\TopHits\TopHitsRequestInterface;
use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-top-hits-aggregation.html
 * @see TopHitsAggregationTest
 */
class TopHitsAggregation implements MetricAggregationInterface
{
    public function __construct(
        protected ?TopHitsRequestInterface $request = null,
    ) {
    }

    public function __clone()
    {
        $this->request = $this->request ? clone $this->request : null;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
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
