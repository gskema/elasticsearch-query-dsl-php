<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\Matcher\MatchAllMatcher;
use PHPUnit\Framework\TestCase;

final class HasPostFilterTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasPostFilterTrait $object */
        $object = new class {
            use HasPostFilterTrait;
        };

        $object->setPostFilter(new MatchAllMatcher());

        self::assertEquals(new MatchAllMatcher(), $object->getPostFilter());
    }
}
