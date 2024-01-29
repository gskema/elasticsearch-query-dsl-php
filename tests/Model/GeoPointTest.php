<?php

namespace Gskema\ElasticsearchQueryDSL\Model;

use PHPUnit\Framework\TestCase;

final class GeoPointTest extends TestCase
{
    public function testMethods(): void
    {
        $geoPoint = new GeoPoint(1, 2);

        self::assertEquals(1, $geoPoint->getLat());
        self::assertEquals(2, $geoPoint->getLon());
        self::assertEquals(['lat' => 1, 'lon' => 2], $geoPoint->jsonSerialize());
    }
}
