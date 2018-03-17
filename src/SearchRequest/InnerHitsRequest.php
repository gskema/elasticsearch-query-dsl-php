<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;
use Gskema\ElasticSearchQueryDSL\Sorter\SorterInterface;
use JsonSerializable;
use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-inner-hits.html
 * @see InnerHitsRequestTest
 *
 * @options 'explain' => true,
 *          'version' => true,
 */
class InnerHitsRequest implements JsonSerializable
{
    use HasOptionsTrait;
    use HasSizeTrait;
    use HasFromTrait;
    use HasSortersTrait;
    use HasHighlighterTrait;
    use HasSourceFieldsTrait;
    use HasScriptFieldsTrait;
    use HasDocValueFieldsTrait;

    /** @var string|null */
    protected $name;

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name): InnerHitsRequest
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = $this->options;

        if (null !== $this->name) {
            $body['name'] = $this->name;
        }
        if (null !== $this->sourceFields) {
            $body['_source'] = $this->sourceFields->jsonSerialize();
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
