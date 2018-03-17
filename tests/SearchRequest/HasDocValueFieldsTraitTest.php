<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use PHPUnit\Framework\TestCase;

class HasDocValueFieldsTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasDocValueFieldsTrait $object */
        $object = $this->getMockBuilder(HasDocValueFieldsTrait::class)->getMockForTrait();

        $object->setDocValueFields(['field1', 'field2']);

        $this->assertEquals(['field1', 'field2'], $object->getDocValueFields());
    }
}
