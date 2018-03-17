<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use PHPUnit\Framework\TestCase;

class HasSizeTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasSizeTrait $object */
        $object = $this->getMockBuilder(HasSizeTrait::class)->getMockForTrait();

        $object->setSize(7);

        $this->assertEquals(7, $object->getSize());
    }
}
