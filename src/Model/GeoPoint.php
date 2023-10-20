<?php

namespace Gskema\ElasticSearchQueryDSL\Model;

/**
 * @see GeoPointTest
 */
class GeoPoint implements GeoPointInterface
{
    public function __construct(
        protected float|string $lat,
        protected float|string $lon,
    ) {
    }

    public function getLat(): float|string
    {
        return $this->lat;
    }

    public function getLon(): float|string
    {
        return $this->lon;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'lat' => $this->lat,
            'lon' => $this->lon,
        ];
    }
}
