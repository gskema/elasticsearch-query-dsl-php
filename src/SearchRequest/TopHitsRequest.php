<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticSearchQueryDSL\Sorter\SorterInterface;
use JsonSerializable;
use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-inner-hits.html
 * @see TopHitsRequest
 *
 * @options 'explain' => true,
 *          'version' => true,
 */
class TopHitsRequest implements JsonSerializable
{
    use HasFromTrait;
    use HasSizeTrait;
    use HasSortersTrait;
    use HasHighlighterTrait;
    use HasSourceFieldsTrait;
    use HasStoredFieldsTrait;
    use HasScriptFieldsTrait;
    use HasDocValueFieldsTrait;
    use HasOptionsTrait;

    public function __clone()
    {
        $this->highlighter = $this->highlighter ? clone $this->highlighter : null;
        $this->sourceFields = $this->sourceFields ? clone $this->sourceFields : null;
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
        if (!empty($this->sorters)) {
            $rawSorters = array_map(function (SorterInterface $sorter) {
                return $sorter->jsonSerialize();
            }, $this->sorters);
            $body['sort'] = 1 === count($this->sorters) ? $rawSorters[0] : $rawSorters;
        }
        if (null !== $this->highlighter) {
            $body['highlight'] = $this->highlighter->jsonSerialize();
        }

        $body = $body ?: new stdClass();

        return $body;
    }
}
