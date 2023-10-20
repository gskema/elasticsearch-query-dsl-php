<?php

namespace Gskema\ElasticSearchQueryDSL\Sorter;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Model\GeoPointInterface;
use Gskema\ElasticSearchQueryDSL\Options;

use function Gskema\ElasticSearchQueryDSL\array_clone;
use function Gskema\ElasticSearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-sort.html#geo-sorting
 * @see GeoDistanceSorterTest
 */
#[Options([
    'distance_type' => 'arc', // 'plane',
])]
class GeoDistanceSorter implements SorterInterface
{
    use HasOptionsTrait;

    public function __construct(
        protected string $field,
        /** @var GeoPointInterface[] */
        protected array $origins,
        protected ?string $unit = null, // 'km', 'm', ...
        protected ?string $order = null, // 'asc', 'desc'
        protected ?string $mode = null, // 'min', 'max', 'sum', 'avg', 'median'
    ) {
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

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(?string $unit): static
    {
        $this->unit = $unit;
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
        $body[$this->field] = $this->field;

        $rawPoints = obj_array_json_serialize($this->origins);
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
