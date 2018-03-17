<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use PHPUnit\Framework\TestCase;

class HasStoredFieldsTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasStoredFieldsTrait $object */
        $object = $this->getMockBuilder(HasStoredFieldsTrait::class)->getMockForTrait();

        $object->setStoredFields(['field1', 'field2']);

        $this->assertEquals(['field1', 'field2'], $object->getStoredFields());
    }
}
