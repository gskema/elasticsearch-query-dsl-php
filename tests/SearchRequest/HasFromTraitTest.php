<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use PHPUnit\Framework\TestCase;

final class HasFromTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasFromTrait $object */
        $object = new class {
            use HasFromTrait;
        };

        $object->setFrom(10);

        self::assertEquals(10, $object->getFrom());
    }
}
