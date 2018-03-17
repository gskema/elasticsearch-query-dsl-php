<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class ExistsMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "exists": {
                    "field": "field1"
                }
            }',
            new ExistsMatcher('field1'),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new ExistsMatcher('field1');
        $this->assertInstanceOf(ExistsMatcher::class, $matcher1);
    }
}
