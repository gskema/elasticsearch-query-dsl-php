<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\SourceFilter\DisabledSourceFilter;
use PHPUnit\Framework\TestCase;

class HasSourceFieldsTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasSourceFieldsTrait $object */
        $object = $this->getMockBuilder(HasSourceFieldsTrait::class)->getMockForTrait();

        $object->setSourceFields(new DisabledSourceFilter());

        $this->assertEquals(new DisabledSourceFilter(), $object->getSourceFields());
    }
}
