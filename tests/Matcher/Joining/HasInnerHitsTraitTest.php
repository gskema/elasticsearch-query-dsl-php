<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHitsRequest;
use PHPUnit\Framework\TestCase;

class HasInnerHitsTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasInnerHitsTrait $object */
        $object = $this->getMockForTrait(HasInnerHitsTrait::class);

        $object->setInnerHits((new InnerHitsRequest())->setName('name1'));

        $this->assertEquals(true, $object->hasInnerHits());
        $this->assertEquals(
            (new InnerHitsRequest())->setName('name1'),
            $object->getInnerHits()
        );
    }
}
