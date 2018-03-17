<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class TermsAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "terms": {
                    "field": "field1",
                    "order": {
                        "_count": "asc"
                    }
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            TermsAggregation::fromField('field1', ['order' => ['_count' => 'asc']])
                ->setAgg('key1', new GlobalAggregation()),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "terms": {
                    "field": "field1",
                    "order": {
                        "_count": "asc"
                    },
                    "script": "source1"
                }
            }',
            TermsAggregation::fromField('field1', ['order' => ['_count' => 'asc']], new InlineScript('source1')),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg1 = TermsAggregation::fromField('field1', ['order' => ['_count' => 'asc']], new InlineScript('source1'));
        $this->assertInstanceOf(TermsAggregation::class, $agg1);

        $agg2 = TermsAggregation::fromScript(new InlineScript('source1'), ['order' => ['_count' => 'asc']]);
        $this->assertInstanceOf(TermsAggregation::class, $agg2);
    }
}
