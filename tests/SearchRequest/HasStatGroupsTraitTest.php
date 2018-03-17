<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use PHPUnit\Framework\TestCase;

class HasStatGroupsTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasStatGroupsTrait $object */
        $object = $this->getMockBuilder(HasStatGroupsTrait::class)->getMockForTrait();

        $object
            ->setStatGroups(['group1', 'group2'])
            ->addStatGroup('group3');

        $this->assertEquals(['group1', 'group2', 'group3'], $object->getStatGroups());
    }
}
