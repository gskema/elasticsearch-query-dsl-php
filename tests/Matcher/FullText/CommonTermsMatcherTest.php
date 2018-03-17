<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class CommonTermsMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "common": {
                    "field1": {
                        "query": "query1",
                        "cutoff_frequency": 0.1
                    }
                }
            }',
            new CommonTermsMatcher('field1', 'query1', 0.1),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new CommonTermsMatcher('field1', 'query1', 0.1);
        $this->assertInstanceOf(CommonTermsMatcher::class, $matcher1);
    }
}
