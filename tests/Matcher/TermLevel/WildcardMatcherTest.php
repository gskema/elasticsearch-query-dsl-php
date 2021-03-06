<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class WildcardMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "wildcard": {
                    "field1": "value1*"
                }
            }',
            new WildcardMatcher('field1', 'value1*'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "wildcard": {
                    "field1": {
                        "value": "value1*",
                        "boost": 2.0
                    }
                }
            }',
            new WildcardMatcher('field1', 'value1*', ['boost' => 2.0]),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new WildcardMatcher('field1', 'value1*');
        $this->assertInstanceOf(WildcardMatcher::class, $matcher1);
    }
}
