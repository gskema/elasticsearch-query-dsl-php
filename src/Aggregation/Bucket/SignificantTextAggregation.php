<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Options;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use function Gskema\ElasticSearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-bucket-significanttext-aggregation.html
 * @see SignificantTextAggregationTest
 */
#[Options([
    'filter_duplicate_text' => true,
    'size' => 3,
    'shard_size' => 3,
    'min_doc_count' => 3,
    'shard_min_doc_count' => 1,
    'background_filter' => MatcherInterface::class,
    'source_fields' => ['content', 'title'],
    'include' => '.*sport.*',
    'exclude' => 'water_.*',
    'mutual_information' => ['include_negatives' => false, 'background_is_superset' => false],
    'chi_square' => ['include_negatives' => false, 'background_is_superset' => false],
    'jlh' => '?',
    'gnd' => ['background_is_superset' => false],
])]
class SignificantTextAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->options = array_clone($this->options);
        $this->aggs = array_clone($this->aggs);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $aggBody = [];
        $aggBody['field'] = $this->field;
        $aggBody += $this->options;

        if (!empty($aggBody['background_filter']) && $aggBody['background_filter'] instanceof MatcherInterface) {
            $aggBody['background_filter'] = $aggBody['background_filter']->jsonSerialize();
        }

        $body = [];
        $body['significant_text'] = $aggBody;
        if (!empty($this->aggs)) {
            $body['aggs'] = obj_array_json_serialize($this->aggs);
        }

        return $body;
    }
}
