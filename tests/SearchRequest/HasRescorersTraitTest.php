<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchNoneMatcher;
use Gskema\ElasticSearchQueryDSL\Rescorer\QueryRescorer;
use PHPUnit\Framework\TestCase;

class HasRescorersTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasRescorersTrait $object */
        $object = $this->getMockBuilder(HasRescorersTrait::class)->getMockForTrait();

        $object->setRescorers([
            new QueryRescorer(new MatchAllMatcher())
        ]);
        $object->addRescorer(new QueryRescorer(new MatchNoneMatcher()));

        $this->assertEquals([
            new QueryRescorer(new MatchAllMatcher()),
            new QueryRescorer(new MatchNoneMatcher()),

        ], $object->getRescorers());
    }
}
