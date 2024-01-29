<?php

namespace Gskema\ElasticsearchQueryDSL\Sorter;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-sort.html
 * @see FieldSorterTest
 */
#[Options([
    'missing' => '_first', // '_last',
    'unmapped_type' => 'long',
])]
class FieldSorter implements SorterInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected string $field,
        protected ?string $order = null, // 'asc', 'desc'
        protected ?string $mode = null, // 'min', 'max', 'sum', 'avg', 'median'
    ) {
    }

    public function getField(): string
    {
        return $this->field;
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
        if (null !== $this->order) {
            $body['order'] = $this->order;
        }
        if (null !== $this->mode) {
            $body['mode'] = $this->mode;
        }
        $body += $this->options;

        if (empty($body)) {
            $body = $this->field;
        } else {
            $body = [
                $this->field => $body,
            ];
        }

        return $body;
    }
}
