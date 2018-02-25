<?php

namespace Gskema\ElasticSearchQueryDSL\Model;

class GeoPoint implements GeoPointInterface
{
    /** @var float */
    protected $lat;

    /** @var float */
    protected $lon;

    public function __construct(float $lat, float $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLon(): float
    {
        return $this->lon;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'lat' => $this->lat,
            'lon' => $this->lon,
        ];
    }
}
