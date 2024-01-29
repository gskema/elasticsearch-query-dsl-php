<?php

namespace Gskema\ElasticsearchQueryDSL;

use JsonSerializable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

abstract class AbstractJsonSerializeTestCase extends TestCase
{
    abstract public static function dataTestJsonSerialize(): iterable;

    #[DataProvider('dataTestJsonSerialize')]
    public function testJsonSerialize(string $expectedJson, JsonSerializable $givenJsonObj): void
    {
        self::assertJsonStringEqualsJsonString($expectedJson, json_encode($givenJsonObj));
    }

    #[DataProvider('dataTestJsonSerialize')]
    public function testClone(string $expectedJson, JsonSerializable $givenJsonObj): void
    {
        $obj0 = $givenJsonObj;
        $obj1 = clone $givenJsonObj;

        $ref = (new ReflectionClass($obj0));
        $className = $ref->getName();
        $shortClassName = $ref->getShortName();
        $properties = $ref->getProperties();

        if (empty($properties)) {
            self::assertTrue(true);
        }

        foreach ($properties as $property) {
            $propName = $property->getName();

            $val0 = $property->getValue($obj0);
            $val1 = $property->getValue($obj1);

            self::assertEquals(
                $val0,
                $val1,
                sprintf(
                    'Expected %s:$%s to be equal after cloning',
                    $className,
                    $propName
                )
            );
            self::assertNotHashEquals($val0, $val1, sprintf('property "%s"', $propName));
            if (is_array($val0) && is_array($val1)) {
                self::assertNotArrayHashEquals($val0, $val1, $shortClassName . '::$' . $propName);
            }
        }
    }

    protected static function assertNotHashEquals(mixed $value1, mixed $value2, string $propertyText): void
    {
        $hash0 = is_object($value1) ? md5(spl_object_hash($value1)) : null;
        $hash1 = is_object($value2) ? md5(spl_object_hash($value2)) : null;

        if ($hash0 && $hash1) {
            static::assertNotEquals(
                $hash0,
                $hash1,
                sprintf(
                    'Expected %s to have different spl_object_hash()',
                    $propertyText
                )
            );
        }
    }

    /**
     * @param mixed[] $array1
     * @param mixed[] $array2
     */
    protected static function assertNotArrayHashEquals(array $array1, array $array2, string $path): void
    {
        foreach ($array1 as $key => $val1) {
            $subPath = $path ? $path . '[' . $key . ']' : null;
            $val2 = $array2[$key] ?? null;
            if (is_array($val1) && is_array($val2)) {
                self::assertNotArrayHashEquals($val1, $val2, $subPath);
            } elseif (is_object($val1) && is_object($val2)) {
                self::assertNotHashEquals($val1, $val2, sprintf('array property "%s"', $subPath));
            }
        }
    }
}
