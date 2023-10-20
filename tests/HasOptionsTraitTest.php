<?php

namespace Gskema\ElasticSearchQueryDSL;

use PHPUnit\Framework\TestCase;

final class HasOptionsTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasOptionsTrait $givenObject */
        $givenObject = new class {
            use HasOptionsTrait;
        };

        self::assertEquals(false, $givenObject->hasOptions());
        self::assertEquals(false, $givenObject->hasOption('key1'));

        $givenObject->setOptions(['key1' => 'value1']);
        $givenObject->setOption('key2', 'value2');

        self::assertEquals(true, $givenObject->hasOptions());
        self::assertEquals(true, $givenObject->hasOption('key1'));
        self::assertEquals(true, $givenObject->hasOption('key2'));
        self::assertEquals(false, $givenObject->hasOption('key3'));

        self::assertEquals('value1', $givenObject->getOption('key1'));
        self::assertEquals('value2', $givenObject->getOption('key2'));
        self::assertEquals([
            'key1' => 'value1',
            'key2' => 'value2',
        ], $givenObject->getOptions());

        $givenObject->removeOption('key2');
        self::assertEquals(['key1' => 'value1'], $givenObject->getOptions());

        $givenObject->removeOptions();
        self::assertEquals([], $givenObject->getOptions());
    }
}
