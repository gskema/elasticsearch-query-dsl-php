<?php

namespace Gskema\ElasticSearchQueryDSL\Sorter;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-sort.html
 * @see FieldSorterTest
 *
 * @options 'missing' => '_first', '_last',
 *          'unmapped_type' => 'long',
 */
class FieldSorter implements SorterInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string|null 'asc', 'desc' */
    protected $order;

    /** @var string|null 'min', 'max', 'sum', 'avg', 'median' */
    protected $mode;

    public function __construct(string $field, string $order = null, string $mode = null)
    {
        $this->field = $field;
        $this->order = $order;
        $this->mode = $mode;
    }

    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string|null
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string|null $order
     *
     * @return $this
     */
    public function setOrder(string $order = null): FieldSorter
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMode()
    {
        return $this->order;
    }

    /**
     * @param string|null $mode
     *
     * @return $this
     */
    public function setMode(string $mode = null): FieldSorter
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
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
