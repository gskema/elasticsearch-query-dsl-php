<?php

namespace Gskema\ElasticsearchQueryDSL\Model;

use PHPUnit\Framework\TestCase;

final class GeoHashTest extends TestCase
{
    public function testMethods(): void
    {
        $geoHash = new GeoHash('abc123');

        self::assertEquals('abc123', $geoHash->getValue());
        self::assertEquals('abc123', $geoHash->__toString());
        self::assertEquals('abc123', (string)$geoHash);
        self::assertEquals('abc123', $geoHash->jsonSerialize());
    }
}
