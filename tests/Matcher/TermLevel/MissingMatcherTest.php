<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MissingMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "bool": {
                    "must_not": {
                        "exists": {
                            "field": "field1"
                        }
                    }
                }
            }',
            new MissingMatcher('field1'),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new MissingMatcher('field1');
        $this->assertInstanceOf(MissingMatcher::class, $matcher1);
    }
}
