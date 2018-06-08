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

        $ref = (new ReflectionClass($obj0));
        $className = $ref->getName();
        $shortClassName = $ref->getShortName();
        $properties = $ref->getProperties();

        if (empty($properties)) {
            $this->assertTrue(true);
        }

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $propName = $property->getName();

            $val0 = $property->getValue($obj0);
            $val1 = $property->getValue($obj1);

            $this->assertEquals($val0, $val1, sprintf(
                'Expected %s:$%s to be equal after cloning',
                $className,
                $propName
            ));
            $this->assertNotHashEquals($val0, $val1, sprintf('property "%s"', $propName));
            if (is_array($val0) && is_array($val1)) {
                $this->assertNotArrayHashEquals($val0, $val1, $shortClassName.'::$'.$propName);
            }
        }
    }

    protected function assertNotHashEquals($value1, $value2, string $propertyText)
    {
        $hash0 = is_object($value1) ? md5(spl_object_hash($value1)) : null;
        $hash1 = is_object($value2) ? md5(spl_object_hash($value2)) : null;

        if ($hash0 && $hash1) {
            $this->assertNotEquals($hash0, $hash1, sprintf(
                'Expected %s to have different spl_object_hash()',
                $propertyText
            ));
        }
    }

    protected function assertNotArrayHashEquals(array $array1, array $array2, string $path)
    {
        foreach ($array1 as $key => $val1) {
            $subPath = $path ? $path.'['.$key.']' : null;
            $val2 = $array2[$key] ?? null;
            if (is_array($val1) && is_array($val2)) {
                $this->assertNotArrayHashEquals($val1, $val2, $subPath);
            } elseif (is_object($val1) && is_object($val2)) {
                $this->assertNotHashEquals($val1, $val2, sprintf('array property "%s"', $subPath));
            }
        }
    }
}
