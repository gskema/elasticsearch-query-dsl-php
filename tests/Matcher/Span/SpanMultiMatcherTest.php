<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\PrefixMatcher;

final class SpanMultiMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "span_multi": {
                    "match": { "prefix": { "field1": "prefix1" } }
                }
            }',
            new SpanMultiMatcher(
                new PrefixMatcher('field1', 'prefix1')
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new SpanMultiMatcher(
            new PrefixMatcher('field1', 'prefix1')
        );
        self::assertInstanceOf(SpanMultiMatcher::class, $matcher1);
    }
}
