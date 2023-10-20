<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Sorter\FieldSorter;
use Gskema\ElasticSearchQueryDSL\Sorter\RawSorter;
use PHPUnit\Framework\TestCase;

final class HasSortersTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasSortersTrait $object */
        $object = new class {
            use HasSortersTrait;
        };

        $object->setSorters([
            new FieldSorter('field1')
        ]);
        $object->addSorter(new RawSorter('field2'));

        self::assertEquals([
            new FieldSorter('field1'),
            new RawSorter('field2'),
        ], $object->getSorters());
    }
}
