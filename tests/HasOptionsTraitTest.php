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

        $this->assertEquals($givenObject->hasOptions(), false);
        $this->assertEquals($givenObject->hasOption('key1'), false);;

        $givenObject->setOptions(['key1' => 'value1']);
        $givenObject->setOption('key2', 'value2');

        $this->assertEquals($givenObject->hasOptions(), true);
        $this->assertEquals($givenObject->hasOption('key1'), true);
        $this->assertEquals($givenObject->hasOption('key2'), true);
        $this->assertEquals($givenObject->hasOption('key3'), false);

        $this->assertEquals($givenObject->getOption('key1'), 'value1');
        $this->assertEquals($givenObject->getOption('key2'), 'value2');
        $this->assertEquals($givenObject->getOptions(), [
            'key1' => 'value1',
            'key2' => 'value2',
        ]);

        $givenObject->removeOption('key2');
        $this->assertEquals($givenObject->getOptions(), ['key1' => 'value1']);

        $givenObject->removeOptions();
        $this->assertEquals($givenObject->getOptions(), []);
    }
}
