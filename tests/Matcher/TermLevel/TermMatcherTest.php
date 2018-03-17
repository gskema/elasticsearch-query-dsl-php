<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class TermMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "term": {
                    "field1": "value1"
                }
            }',
            new TermMatcher('field1', 'value1'),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new TermMatcher('field1', 'value1');
        $this->assertInstanceOf(TermMatcher::class, $matcher1);
    }
}
