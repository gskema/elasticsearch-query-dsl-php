<?php

namespace Gskema\ElasticSearchQueryDSL;

use PHPUnit\Framework\TestCase;

class HasOptionsTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasOptionsTrait $givenObject */
        $givenObject = $this
            ->getMockBuilder(HasOptionsTrait::class)
            ->setMethods(null)
            ->getMockForTrait();

        $this->assertEquals(false, $givenObject->hasOptions());
        $this->assertEquals(false, $givenObject->hasOption('key1'));

        $givenObject->setOptions(['key1' => 'value1']);
        $givenObject->setOption('key2', 'value2');

        $this->assertEquals(true, $givenObject->hasOptions());
        $this->assertEquals(true, $givenObject->hasOption('key1'));
        $this->assertEquals(true, $givenObject->hasOption('key2'));
        $this->assertEquals(false, $givenObject->hasOption('key3'));

        $this->assertEquals('value1', $givenObject->getOption('key1'));
        $this->assertEquals('value2', $givenObject->getOption('key2'));
        $this->assertEquals([
            'key1' => 'value1',
            'key2' => 'value2',
        ], $givenObject->getOptions());

        $givenObject->removeOption('key2');
        $this->assertEquals(['key1' => 'value1'], $givenObject->getOptions());

        $givenObject->removeOptions();
        $this->assertEquals([], $givenObject->getOptions());
    }
}
