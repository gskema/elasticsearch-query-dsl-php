<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class SignificantTermsAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "significant_terms": {
                    "field": "field1",
                    "mutual_information": {
                        "include_negatives": false,
                        "background_is_superset": false
                    },
                    "background_filter": { "match_all": {} },
                    "scripted_heuristic": "source1"
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new SignificantTermsAggregation('field1'))
                ->setOption('mutual_information', ['include_negatives' => false, 'background_is_superset' => false])
                ->setOption('background_filter', new MatchAllMatcher())
                ->setOption('scripted_heuristic', new InlineScript('source1'))
                ->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = (new SignificantTermsAggregation('field1'))
            ->setOption('mutual_information', ['include_negatives' => false, 'background_is_superset' => false])
            ->setOption('background_filter', new MatchAllMatcher())
            ->setOption('scripted_heuristic', new InlineScript('source1'))
            ->setAgg('key1', new GlobalAggregation());
        $this->assertInstanceOf(SignificantTermsAggregation::class, $agg);
    }
}
