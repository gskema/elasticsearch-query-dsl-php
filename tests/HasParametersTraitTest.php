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

        $this->assertEquals($givenObject->hasParameters(), false);
        $this->assertEquals($givenObject->hasParameter('key1'), false);;

        $givenObject->setParameters(['key1' => 'value1']);
        $givenObject->setParameter('key2', 'value2');

        $this->assertEquals($givenObject->hasParameters(), true);
        $this->assertEquals($givenObject->hasParameter('key1'), true);
        $this->assertEquals($givenObject->hasParameter('key2'), true);
        $this->assertEquals($givenObject->hasParameter('key3'), false);

        $this->assertEquals($givenObject->getParameter('key1'), 'value1');
        $this->assertEquals($givenObject->getParameter('key2'), 'value2');
        $this->assertEquals($givenObject->getParameters(), [
            'key1' => 'value1',
            'key2' => 'value2',
        ]);

        $givenObject->removeParameter('key2');
        $this->assertEquals($givenObject->getParameters(), ['key1' => 'value1']);

        $givenObject->removeParameters();
        $this->assertEquals($givenObject->getParameters(), []);
    }
}
