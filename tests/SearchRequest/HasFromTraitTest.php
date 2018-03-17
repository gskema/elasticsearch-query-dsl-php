<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use PHPUnit\Framework\TestCase;

class HasFromTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasFromTrait $object */
        $object = $this->getMockBuilder(HasFromTrait::class)->getMockForTrait();

        $object->setFrom(10);

        $this->assertEquals(10, $object->getFrom());
    }
}
