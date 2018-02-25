<?php

namespace Gskema\ElasticSearchQueryDSL\FieldCollapser;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHitsRequest;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-collapse.html
 * @see FieldCollapserTest
 *
 * @options 'max_concurrent_group_searches' => 4,
 */
class FieldCollapser implements FieldCollapserInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var InnerHitsRequest[] */
    protected $innerHits = [];

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return InnerHitsRequest[]
     */
    public function getInnerHits(): array
    {
        return $this->innerHits;
    }

    /**
     * @param InnerHitsRequest[] $requests
     *
     * @return $this
     */
    public function setInnerHits(array $requests): FieldCollapser
    {
        $this->innerHits = $requests;

        return $this;
    }

    /**
     * @param InnerHitsRequest $request
     *
     * @return $this
     */
    public function addInnerHits(InnerHitsRequest $request): FieldCollapser
    {
        $this->innerHits[] = $request;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body['field'] = $this->field;
        if (count($this->innerHits) > 1) {
            foreach ($this->innerHits as $request) {
                $body['inner_hits'][] = $request->jsonSerialize();
            }
        } elseif (1 === count($this->innerHits)) {
            $body['inner_hits'] = $this->innerHits[0]->jsonSerialize();
        }
        $body += $this->options;

        return $body;
    }
}
