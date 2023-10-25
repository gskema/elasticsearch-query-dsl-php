<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest\TopHits;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Options;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasDocValueFieldsTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasFromTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasHighlighterTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasScriptFieldsTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasSizeTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasSortersTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasSourceFieldsTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasStoredFieldsTrait;
use stdClass;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use function Gskema\ElasticSearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-inner-hits.html
 * @see TopHitsRequest
 */
#[Options([
    'explain' => true,
    'version' => true,
])]
class TopHitsRequest implements TopHitsRequestInterface
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
        $this->sorters = array_clone($this->sorters);
        $this->highlighter = $this->highlighter ? clone $this->highlighter : null;
        $this->sourceFields = $this->sourceFields ? clone $this->sourceFields : null;
        $this->scriptFields = array_clone($this->scriptFields);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = $this->options;

        if (null !== $this->sourceFields) {
            $body['_source'] = $this->jsonSerializeSourceFields();
        }
        if (null !== $this->storedFields) {
            $body['stored_fields'] = $this->storedFields;
        }
        if (!empty($this->scriptFields)) {
            $body['script_fields'] = obj_array_json_serialize($this->scriptFields);
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
            $body['sort'] = $this->jsonSerializeSorters();
        }
        if (null !== $this->highlighter) {
            $body['highlight'] = $this->highlighter->jsonSerialize();
        }

        return $body ?: new stdClass();
    }
}
