<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-bucket-significantterms-aggregation.html
 * @see SignificantTermsAggregationTest
 *
 * @options 'background_filter' => MatcherInterface,
 *          'size' => 3,
 *          'shard_size' => 3,
 *          'mutual_information' => ['include_negatives' => false, 'background_is_superset' => false],
 *          'chi_square' => ['include_negatives' => false, 'background_is_superset' => false],
 *          'jlh' => ?,
 *          'gnd' => ['background_is_superset' => false],
 *          'percentage' => new \stdClass(),
 *          'scripted_heuristic' => ScriptInterface,
 *          'min_doc_count' => 3,
 *          'shard_min_doc_count' => 1,
 *          'include' => '.*sport.*',
 *          'exclude' => 'water_.*',
 *          'execution_hint' => 'map',
 */
class SignificantTermsAggregation implements BucketAggregationInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;

    /** @var string */
    protected $field;

    public function __construct(string $field, array $options = [])
    {
        $this->field = $field;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->options = array_clone($this->options);
        $this->aggs = array_clone($this->aggs);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $aggBody = [];
        $aggBody['field'] = $this->field;
        $aggBody += $this->options;

        if (!empty($aggBody['background_filter'])) {
            /** @var MatcherInterface $filter */
            $filter = $aggBody['background_filter'];
            $aggBody['background_filter'] = $filter->jsonSerialize();
        }

        if (!empty($aggBody['scripted_heuristic'])) {
            /** @var ScriptInterface $script */
            $script = $aggBody['scripted_heuristic'];
            $aggBody['scripted_heuristic'] = $script->jsonSerialize();
        }

        $body = [];
        $body['significant_terms'] = $aggBody;
        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        return $body;
    }
}
