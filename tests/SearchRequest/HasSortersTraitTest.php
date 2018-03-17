<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Sorter\FieldSorter;
use Gskema\ElasticSearchQueryDSL\Sorter\RawSorter;
use PHPUnit\Framework\TestCase;

class HasSortersTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasSortersTrait $object */
        $object = $this->getMockBuilder(HasSortersTrait::class)->getMockForTrait();

        $object->setSorters([
            new FieldSorter('field1')
        ]);
        $object->addSorter(new RawSorter('field2'));

        $this->assertEquals([
            new FieldSorter('field1'),
            new RawSorter('field2'),
        ], $object->getSorters());
    }
}
