<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class PrefixMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "prefix": {
                    "field1": "prefix1"
                }
            }',
            new PrefixMatcher('field1', 'prefix1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "prefix": {
                    "field1": {
                        "value": "prefix1",
                        "boost": 1.0
                    }
                }
            }',
            new PrefixMatcher('field1', 'prefix1', ['boost' => 1.0]),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new PrefixMatcher('field1', 'prefix1');
        $this->assertInstanceOf(PrefixMatcher::class, $matcher1);
    }
}
