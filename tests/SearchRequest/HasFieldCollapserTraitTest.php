<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\FieldCollapser\FieldCollapser;
use PHPUnit\Framework\TestCase;

final class HasFieldCollapserTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasFieldCollapserTrait $object */
        $object = new class {
            use HasFieldCollapserTrait;
        };

        $object->setFieldCollapser(new FieldCollapser('field1'));

        self::assertEquals(new FieldCollapser('field1'), $object->getFieldCollapser());
    }
}
