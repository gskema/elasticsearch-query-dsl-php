<?php

namespace Gskema\ElasticSearchQueryDSL\FieldCollapser;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Options;
use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHits\InnerHitsRequestInterface;

use function Gskema\ElasticSearchQueryDSL\array_clone;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-collapse.html
 * @see FieldCollapserTest
 */
#[Options([
    'max_concurrent_group_searches' => 4,
])]
class FieldCollapser implements FieldCollapserInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected string $field,
        /** @var InnerHitsRequestInterface[] */
        protected array $innerHits = [],
    ) {
    }

    public function __clone()
    {
        $this->innerHits = array_clone($this->innerHits);
    }

    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return InnerHitsRequestInterface[]
     */
    public function getInnerHits(): array
    {
        return $this->innerHits;
    }

    /**
     * @param InnerHitsRequestInterface[] $requests
     */
    public function setInnerHits(array $requests): static
    {
        $this->innerHits = $requests;
        return $this;
    }

    public function addInnerHits(InnerHitsRequestInterface $request): static
    {
        $this->innerHits[] = $request;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
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
