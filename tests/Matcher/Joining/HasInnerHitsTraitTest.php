<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHits\InnerHitsRequest;
use PHPUnit\Framework\TestCase;

final class HasInnerHitsTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasInnerHitsTrait $object */
        $object = new class {
            use HasInnerHitsTrait;
        };

        $object->setInnerHits((new InnerHitsRequest())->setName('name1'));

        self::assertEquals(true, $object->hasInnerHits());
        self::assertEquals(
            (new InnerHitsRequest())->setName('name1'),
            $object->getInnerHits()
        );
    }
}
