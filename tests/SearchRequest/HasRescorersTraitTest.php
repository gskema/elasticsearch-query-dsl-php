<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchNoneMatcher;
use Gskema\ElasticSearchQueryDSL\Rescorer\QueryRescorer;
use PHPUnit\Framework\TestCase;

final class HasRescorersTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasRescorersTrait $object */
        $object = new class {
            use HasRescorersTrait;
        };

        $object->setRescorers([
            new QueryRescorer(new MatchAllMatcher())
        ]);
        $object->addRescorer(new QueryRescorer(new MatchNoneMatcher()));

        self::assertEquals([
            new QueryRescorer(new MatchAllMatcher()),
            new QueryRescorer(new MatchNoneMatcher()),

        ], $object->getRescorers());
    }
}
