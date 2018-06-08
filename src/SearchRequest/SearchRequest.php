<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasAggsTrait;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\HasParametersTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticSearchQueryDSL\Rescorer\RescorerInterface;
use Gskema\ElasticSearchQueryDSL\Sorter\SorterInterface;
use Gskema\ElasticSearchQueryDSL\Suggester\SuggesterInterface;
use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-body.html
 * @see SearchRequestTest
 *
 * @options 'track_scores' => true,
 *          'slice' => ['field' => 'date', 'id': 0, 'max' => 10],
 *          'explain' => true,
 *          'version' => true,
 *          'indices_boost' => [['alias1' => 1.4], ['index*' => 1.3]],
 *          'min_score' => 0.5,
 *          'search_after' => [1463538857, "tweet#654323"],
 *
 * @parameters 'routing' => 'kimchy',
 *             'timeout' => '2s',
 *             'terminate_after' => 1,
 *             'max_concurrent_shard_requests' => 2,
 *             'search_type' => 'dfs_query_then_fetch', 'query_then_fetch'
 *             'request_cache' => true,
 *             'batched_reduce_size' => 2,
 *             'scroll' => '1m',
 *             'preference' => ?,
 *             'error_trace' => true,
 */
class SearchRequest implements SearchRequestInterface
{
    use HasOptionsTrait;
    use HasAggsTrait;
    use HasParametersTrait; // URL params

    use HasDocValueFieldsTrait;
    use HasFieldCollapserTrait;
    use HasFromTrait;
    use HasSizeTrait;
    use HasHighlighterTrait;
    use HasPostFilterTrait;
    use HasQueryTrait;
    use HasRescorersTrait;
    use HasScriptFieldsTrait;
    use HasSortersTrait;
    use HasSourceFieldsTrait;
    use HasStatGroupsTrait;
    use HasStoredFieldsTrait;
    use HasSuggestersTrait;

    public function __clone()
    {
        $this->aggs = array_clone($this->aggs);
        $this->fieldCollapser = $this->fieldCollapser ? clone $this->fieldCollapser : null;
        $this->postFilter = $this->postFilter ? clone $this->postFilter : null;
        $this->query = $this->query ? clone $this->query : null;
        $this->highlighter = $this->highlighter ? clone $this->highlighter : null;
        $this->rescorers = array_clone($this->rescorers);
        $this->scriptFields = array_clone($this->scriptFields);
        $this->sorters = array_clone($this->sorters);
        $this->sourceFields = $this->sourceFields ? clone $this->sourceFields : null;
        $this->suggesters = array_clone($this->suggesters);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = $this->options;

        if (null !== $this->sourceFields) {
            $body['_source'] = $this->sourceFields->jsonSerialize();
        }
        if (null !== $this->storedFields) {
            $body['stored_fields'] = $this->storedFields;
        }
        if (!empty($this->scriptFields)) {
            $body['script_fields'] = array_map(function (ScriptInterface $script) {
                return $script->jsonSerialize();
            }, $this->scriptFields);
        }
        if (!empty($this->docValueFields)) {
            $body['docvalue_fields'] = $this->docValueFields;
        }
        if (null !== $this->from) {
            $body['from'] = $this->from;
        }
        if (null !== $this->size) {
            $body['size'] = $this->size;
        }
        if (null !== $this->query) {
            $body['query'] = $this->query->jsonSerialize();
        }
        if (null !== $this->postFilter) {
            $body['post_filter'] = $this->postFilter->jsonSerialize();
        }
        if (!empty($this->sorters)) {
            $rawSorters = array_map(function (SorterInterface $sorter) {
                return $sorter->jsonSerialize();
            }, $this->sorters);
            $body['sort'] = 1 === count($this->sorters) ? $rawSorters[0] : $rawSorters;
        }
        if (!empty($this->rescorers)) {
            $rawRescoreQueries = array_map(function (RescorerInterface $query) {
                return $query->jsonSerialize();
            }, $this->rescorers);
            $body['rescore'] = 1 === count($this->rescorers) ? $rawRescoreQueries[0] : $rawRescoreQueries;
        }
        if (null !== $this->highlighter) {
            $body['highlight'] = $this->highlighter->jsonSerialize();
        }
        if (!empty($this->suggesters)) {
            $body['suggest'] = array_map(function (SuggesterInterface $suggester) {
                return $suggester->jsonSerialize();
            }, $this->suggesters);
        }
        if (!empty($this->statGroups)) {
            $body['stats'] = $this->statGroups;
        }
        if (null !== $this->fieldCollapser) {
            $body['collapse'] = $this->fieldCollapser->jsonSerialize();
        }

        if ($this->hasAggs()) {
            $body['aggs'] = $this->jsonSerializeAggs();
        }

        $body = $body ?: new stdClass();

        return $body;
    }
}
