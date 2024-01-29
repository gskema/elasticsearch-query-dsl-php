<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\SourceFilter\DisabledSourceFilter;
use PHPUnit\Framework\TestCase;

final class HasSourceFieldsTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasSourceFieldsTrait $object */
        $object = new class {
            use HasSourceFieldsTrait;
        };

        $object->setSourceFields(new DisabledSourceFilter());

        self::assertEquals(new DisabledSourceFilter(), $object->getSourceFields());
    }
}
