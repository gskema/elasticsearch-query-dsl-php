<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\Matcher\MatchNoneMatcher;
use PHPUnit\Framework\TestCase;

final class HasQueryTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasQueryTrait $object */
        $object = new class {
            use HasQueryTrait;
        };

        $object->setQuery(new MatchNoneMatcher());

        self::assertEquals(new MatchNoneMatcher(), $object->getQuery());
    }
}
