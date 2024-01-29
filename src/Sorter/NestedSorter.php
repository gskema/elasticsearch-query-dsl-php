<?php

namespace Gskema\ElasticsearchQueryDSL\Sorter;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-sort.html#nested-sorting
 * @see NestedSorterTest
 */
#[Options([
    'missing' => '_first', // '_last',
    'unmapped_type' => 'long',
])]
class NestedSorter implements SorterInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected string $field,
        protected string $nestedPath,
        protected ?MatcherInterface $nestedFilter = null,
        protected ?string $order = null, // 'asc', 'desc'
        protected ?string $mode = null, // /** 'min', 'max', 'sum', 'avg', 'median'
    ) {
    }

    public function __clone()
    {
        $this->nestedFilter = $this->nestedFilter ? clone $this->nestedFilter : null;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getNestedPath(): string
    {
        return $this->nestedPath;
    }

    public function getNestedFilter(): ?MatcherInterface
    {
        return $this->nestedFilter;
    }

    public function setNestedFilter(?MatcherInterface $filter): static
    {
        $this->nestedFilter = $filter;
        return $this;
    }

    public function getOrder(): ?string
    {
        return $this->order;
    }

    public function setOrder(?string $order): static
    {
        $this->order = $order;
        return $this;
    }

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(?string $mode): static
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['nested_path'] = $this->nestedPath;
        if (null !== $this->nestedFilter) {
            $body['nested_filter'] = $this->nestedFilter->jsonSerialize();
        }
        if (null !== $this->order) {
            $body['order'] = $this->order;
        }
        if (null !== $this->mode) {
            $body['mode'] = $this->mode;
        }
        $body += $this->options;

        return [
            $this->field => $body,
        ];
    }
}
