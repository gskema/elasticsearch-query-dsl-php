<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use PHPUnit\Framework\TestCase;

final class HasStoredFieldsTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasStoredFieldsTrait $object */
        $object = new class {
            use HasStoredFieldsTrait;
        };

        $object->setStoredFields(['field1', 'field2']);

        self::assertEquals(['field1', 'field2'], $object->getStoredFields());
    }
}
