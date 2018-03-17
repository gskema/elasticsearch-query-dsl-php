<?php

namespace Gskema\ElasticSearchQueryDSL\Model;

use PHPUnit\Framework\TestCase;

class GeoHashTest extends TestCase
{
    public function testMethods()
    {
        $geoHash = new GeoHash('abc123');

        $this->assertEquals('abc123', $geoHash->getValue());
        $this->assertEquals('abc123', $geoHash->__toString());
        $this->assertEquals('abc123', (string)$geoHash);
        $this->assertEquals('abc123', $geoHash->jsonSerialize());
    }
}
