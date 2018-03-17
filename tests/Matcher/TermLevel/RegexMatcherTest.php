<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class RegexMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
            new RegexMatcher('field1', 'regexp1', ['flags' => 'COMPLEMENT']),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new RegexMatcher('field1', 'regexp1', ['flags' => 'COMPLEMENT']);
        $this->assertInstanceOf(RegexMatcher::class, $matcher1);
    }
}
