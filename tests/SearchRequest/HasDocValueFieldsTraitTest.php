<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use PHPUnit\Framework\TestCase;

final class HasDocValueFieldsTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasDocValueFieldsTrait $object */
        $object = new class {
            use HasDocValueFieldsTrait;
        };

        $object->setDocValueFields(['field1', 'field2']);

        self::assertEquals(['field1', 'field2'], $object->getDocValueFields());
    }
}
