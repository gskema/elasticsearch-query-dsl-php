<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class WrapperMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "wrapper": {
                    "query": "eyJ0ZXJtIiA6IHsgInVzZXIiIDogIkbWNoeSIgfX0="
                }
            }',
            new WrapperMatcher('eyJ0ZXJtIiA6IHsgInVzZXIiIDogIkbWNoeSIgfX0='),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new WrapperMatcher('eyJ0ZXJtIiA6IHsgInVzZXIiIDogIktpbWNoeSIgfX0=');
        self::assertInstanceOf(WrapperMatcher::class, $matcher1);
    }
}
