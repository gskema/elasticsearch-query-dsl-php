<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use PHPUnit\Framework\TestCase;

final class HasSizeTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasSizeTrait $object */
        $object = new class {
            use HasSizeTrait;
        };

        $object->setSize(7);

        self::assertEquals(7, $object->getSize());
    }
}
