<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticsearchQueryDSL\Matcher\MatchNoneMatcher;
use Gskema\ElasticsearchQueryDSL\Rescorer\QueryRescorer;
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
