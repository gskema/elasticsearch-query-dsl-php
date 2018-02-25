<?php

namespace Gskema\ElasticSearchQueryDSL\Sorter;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-sort.html#nested-sorting
 * @see NestedSorterTest
 *
 * @options 'missing' => '_first', '_last',
 *          'unmapped_type' => 'long',
 */
class NestedSorter implements SorterInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string */
    protected $nestedPath;

    /** @var MatcherInterface|null */
    protected $nestedFilter;

    /** @var string|null 'asc', 'desc' */
    protected $order;

    /** @var string|null 'min', 'max', 'sum', 'avg', 'median' */
    protected $mode;

    public function __construct(string $field, string $nestedPath)
    {
        $this->field = $field;
        $this->nestedPath = $nestedPath;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getNestedPath(): string
    {
        return $this->nestedPath;
    }

    /**
     * @return MatcherInterface|null
     */
    public function getNestedFilter()
    {
        return $this->nestedFilter;
    }

    /**
     * @param MatcherInterface|null $filter
     *
     * @return $this
     */
    public function setNestedFilter(MatcherInterface $filter = null): NestedSorter
    {
        $this->nestedFilter = $filter;

        return $this;
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
    public function setOrder(string $order = null): NestedSorter
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
    public function setMode(string $mode = null): NestedSorter
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
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
