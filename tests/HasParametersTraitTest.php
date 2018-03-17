<?php

namespace Gskema\ElasticSearchQueryDSL;

use PHPUnit\Framework\TestCase;

class HasParametersTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasParametersTrait $givenObject */
        $givenObject = $this
            ->getMockBuilder(HasParametersTrait::class)
            ->setMethods(null)
            ->getMockForTrait();

        $this->assertEquals(false, $givenObject->hasParameters());
        $this->assertEquals(false, $givenObject->hasParameter('key1'));

        $givenObject->setParameters(['key1' => 'value1']);
        $givenObject->setParameter('key2', 'value2');

        $this->assertEquals(true, $givenObject->hasParameters());
        $this->assertEquals(true, $givenObject->hasParameter('key1'));
        $this->assertEquals(true, $givenObject->hasParameter('key2'));
        $this->assertEquals(false, $givenObject->hasParameter('key3'));

        $this->assertEquals('value1', $givenObject->getParameter('key1'));
        $this->assertEquals('value2', $givenObject->getParameter('key2'));
        $this->assertEquals([
            'key1' => 'value1',
            'key2' => 'value2',
        ], $givenObject->getParameters());

        $givenObject->removeParameter('key2');
        $this->assertEquals(['key1' => 'value1'], $givenObject->getParameters());

        $givenObject->removeParameters();
        $this->assertEquals([], $givenObject->getParameters());
    }
}
