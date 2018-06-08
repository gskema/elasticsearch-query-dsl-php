<?php

namespace Gskema\ElasticSearchQueryDSL\Sorter;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\GeoPointInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-sort.html#geo-sorting
 * @see GeoDistanceSorterTest
 *
 * @options 'distance_type' => 'arc', 'plane',
 */
class GeoDistanceSorter implements SorterInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var GeoPointInterface[] */
    protected $origins;

    /** @var string|null 'km', 'm', ... */
    protected $unit;

    /** @var string|null 'asc', 'desc' */
    protected $order;

    /** @var string|null 'min', 'max', 'sum', 'avg', 'median' */
    protected $mode;

    /**
     * @param string              $field
     * @param GeoPointInterface[] $origins
     */
    public function __construct(string $field, array $origins)
    {
        $this->field = $field;
        $this->origins = $origins;
    }

    public function __clone()
    {
        $this->origins = array_clone($this->origins);
    }

    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return GeoPointInterface[]
     */
    public function getOrigins(): array
    {
        return $this->origins;
    }

    /**
     * @return string|null
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string|null $unit
     *
     * @return $this
     */
    public function setUnit(string $unit = null): GeoDistanceSorter
    {
        $this->unit = $unit;

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
    public function setOrder(string $order = null): GeoDistanceSorter
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param string|null $mode
     *
     * @return $this
     */
    public function setMode(string $mode = null): GeoDistanceSorter
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
        $body[$this->field] = $this->field;

        $rawPoints = array_map(function (GeoPointInterface $origin) {
            return $origin->jsonSerialize();
        }, $this->origins);
        $body[$this->field] = 1 === count($this->origins) ? $rawPoints[0] : $rawPoints;

        if (null !== $this->unit) {
            $body['unit'] = $this->unit;
        }
        if (null !== $this->order) {
            $body['order'] = $this->order;
        }
        if (null !== $this->mode) {
            $body['mode'] = $this->mode;
        }
        $body += $this->options;

        return [
            '_geo_distance' => $body,
        ];
    }
}
