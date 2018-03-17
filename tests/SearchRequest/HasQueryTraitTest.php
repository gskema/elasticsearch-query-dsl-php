<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Matcher\MatchNoneMatcher;
use PHPUnit\Framework\TestCase;

class HasQueryTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasQueryTrait $object */
        $object = $this->getMockBuilder(HasQueryTrait::class)->getMockForTrait();

        $object->setQuery(new MatchNoneMatcher());

        $this->assertEquals(new MatchNoneMatcher(), $object->getQuery());
    }
}
