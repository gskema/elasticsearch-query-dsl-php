<?php

namespace Gskema\ElasticSearchQueryDSL;

use JsonSerializable;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

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

    /**
     * @dataProvider dataTestJsonSerialize
     *
     * @param string $expectedJson
     * @param JsonSerializable $givenJsonObj
     * @throws ReflectionException
     */
    public function testClone(string $expectedJson, JsonSerializable $givenJsonObj)
    {
        $obj0 = $givenJsonObj;
        $obj1 = clone $givenJsonObj;

        $className = get_class($obj0);
        $properties = (new ReflectionClass($className))->getProperties();

        if (empty($properties)) {
            $this->assertTrue(true);
        }

        foreach ($properties as $property) {
            $property->setAccessible(true);

            $val0 = $property->getValue($obj0);
            $val1 = $property->getValue($obj1);

            $hash0 = is_object($val0) ? md5(spl_object_hash($val0)) : null;
            $hash1 = is_object($val1) ? md5(spl_object_hash($val1)) : null;

            if ($hash0 && $hash1) {
                $this->assertNotEquals($hash0, $hash1, sprintf(
                    'Expected spl_object_hash() of property "%s::$%s" to be different after cloning',
                    $className,
                    $property->getName()
                ));
            }

            $this->assertEquals($val0, $val1, sprintf(
                'Expected %s:$%s to be equal after cloning',
                $className,
                $property->getName()
            ));
        }
    }
}
