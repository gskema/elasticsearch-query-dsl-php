<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use PHPUnit\Framework\TestCase;

final class HasStatGroupsTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasStatGroupsTrait $object */
        $object = new class {
            use HasStatGroupsTrait;
        };

        $object
            ->setStatGroups(['group1', 'group2'])
            ->addStatGroup('group3');

        self::assertEquals(['group1', 'group2', 'group3'], $object->getStatGroups());
    }
}
