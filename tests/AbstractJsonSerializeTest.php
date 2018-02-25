<?php

namespace Gskema\ElasticSearchQueryDSL;

use JsonSerializable;
use PHPUnit\Framework\TestCase;

abstract class AbstractJsonSerializeTest extends TestCase
{
    abstract public function dataTestJsonSerialize(): array;

    /**
     * @dataProvider dataTestJsonSerialize
     *
     * @param string           $expectedJson
     * @param JsonSerializable $givenJsonObj
     */
    public function testJsonSerialize(string $expectedJson, JsonSerializable $givenJsonObj)
    {
        $this->assertJsonStringEqualsJsonString($expectedJson, json_encode($givenJsonObj));
    }
}
