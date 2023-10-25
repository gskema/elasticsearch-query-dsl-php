<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHits;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Options;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasDocValueFieldsTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasFromTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasHighlighterTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasScriptFieldsTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasSizeTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasSortersTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\HasSourceFieldsTrait;
use stdClass;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use function Gskema\ElasticSearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-inner-hits.html
 * @see InnerHitsRequestTest
 */
#[Options([
    'explain' => true,
    'version' => true,
])]
class InnerHitsRequest implements InnerHitsRequestInterface
{
    use HasOptionsTrait;
    use HasSizeTrait;
    use HasFromTrait;
    use HasHighlighterTrait;
    use HasSortersTrait;
    use HasSourceFieldsTrait;
    use HasScriptFieldsTrait;
    use HasDocValueFieldsTrait;

    protected ?string $name = null;

    public function __clone()
    {
        $this->highlighter = $this->highlighter ? clone $this->highlighter : null;
        $this->scriptFields = array_clone($this->scriptFields);
        $this->sorters = array_clone($this->sorters);
        $this->sourceFields = $this->sourceFields ? clone $this->sourceFields : null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = $this->options;

        if (null !== $this->name) {
            $body['name'] = $this->name;
        }
        if (null !== $this->sourceFields) {
            $body['_source'] = $this->jsonSerializeSourceFields();
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
