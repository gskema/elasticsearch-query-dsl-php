<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class TermsMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "terms": {
                    "field1": ["value1", "value2"]
                }
            }',
            new TermsMatcher('field1', ['value1', 'value2']),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new TermsMatcher('field1', ['value1', 'value2']);
        $this->assertInstanceOf(TermsMatcher::class, $matcher1);
    }
}
