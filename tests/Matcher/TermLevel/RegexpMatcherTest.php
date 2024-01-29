<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class RegexpMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "regexp": {
                    "field1": {
                        "value": "regexp1",
                        "flags": "COMPLEMENT"
                    }
                }
            }',
            new RegexpMatcher('field1', 'regexp1', ['flags' => 'COMPLEMENT']),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "regexp": {
                    "field1": "regexp1"
                }
            }',
            new RegexpMatcher('field1', 'regexp1'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new RegexpMatcher('field1', 'regexp1', ['flags' => 'COMPLEMENT']);
        self::assertInstanceOf(RegexpMatcher::class, $matcher1);
    }
}
