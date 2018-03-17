<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use PHPUnit\Framework\TestCase;

class HasPostFilterTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasPostFilterTrait $object */
        $object = $this->getMockBuilder(HasPostFilterTrait::class)->getMockForTrait();

        $object->setPostFilter(new MatchAllMatcher());

        $this->assertEquals(new MatchAllMatcher(), $object->getPostFilter());
    }
}
