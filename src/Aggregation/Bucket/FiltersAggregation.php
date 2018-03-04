<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-filters-aggregation.html
 * @see FiltersAggregationTest
 *
 * @options 'other_bucket'     => true,
 *          'other_bucket_key' => 'custom_key',
 */
class FiltersAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /** @var MatcherInterface[] */
    protected $filters;

    public function __construct(array $filtersByName, array $options = [])
    {
        $this->filters = $filtersByName;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['filters']['filters'] = array_map(function (MatcherInterface $filter) {
            return $filter->jsonSerialize();
        }, $this->filters);
        $body['filters'] += $this->options;

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
