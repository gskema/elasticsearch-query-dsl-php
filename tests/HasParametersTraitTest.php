<?php

namespace Gskema\ElasticSearchQueryDSL;

use PHPUnit\Framework\TestCase;

final class HasParametersTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasParametersTrait $givenObject */
        $givenObject = new class {
            use HasParametersTrait;
        };

        self::assertEquals(false, $givenObject->hasParameters());
        self::assertEquals(false, $givenObject->hasParameter('key1'));

        $givenObject->setParameters(['key1' => 'value1']);
        $givenObject->setParameter('key2', 'value2');

        self::assertEquals(true, $givenObject->hasParameters());
        self::assertEquals(true, $givenObject->hasParameter('key1'));
        self::assertEquals(true, $givenObject->hasParameter('key2'));
        self::assertEquals(false, $givenObject->hasParameter('key3'));

        self::assertEquals('value1', $givenObject->getParameter('key1'));
        self::assertEquals('value2', $givenObject->getParameter('key2'));
        self::assertEquals([
            'key1' => 'value1',
            'key2' => 'value2',
        ], $givenObject->getParameters());

        $givenObject->removeParameter('key2');
        self::assertEquals(['key1' => 'value1'], $givenObject->getParameters());

        $givenObject->removeParameters();
        self::assertEquals([], $givenObject->getParameters());
    }
}
