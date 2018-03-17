<?php

namespace Gskema\ElasticSearchQueryDSL\Model;

use PHPUnit\Framework\TestCase;

class GeoPointTest extends TestCase
{
    public function testMethods()
    {
        $geoPoint = new GeoPoint(1, 2);

        $this->assertEquals(1, $geoPoint->getLat());
        $this->assertEquals(2, $geoPoint->getLon());
        $this->assertEquals(['lat' => 1, 'lon' => 2], $geoPoint->jsonSerialize());
    }
}
