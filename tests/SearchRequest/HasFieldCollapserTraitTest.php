<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\FieldCollapser\FieldCollapser;
use PHPUnit\Framework\TestCase;

class HasFieldCollapserTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasFieldCollapserTrait $object */
        $object = $this->getMockBuilder(HasFieldCollapserTrait::class)->getMockForTrait();

        $object->setFieldCollapser(new FieldCollapser('field1'));

        $this->assertEquals(new FieldCollapser('field1'), $object->getFieldCollapser());
    }
}
