<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class ScriptedMetricAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "scripted_metric": {
                    "init_script": "source1",
                    "map_script": "source2",
                    "combine_script": "source3",
                    "reduce_script": "source4"
                }
            }',
            (new ScriptedMetricAggregation())
            ->setInitScript(new InlineScript('source1'))
            ->setMapScript(new InlineScript('source2'))
            ->setCombineScript(new InlineScript('source3'))
            ->setReduceScript(new InlineScript('source4')),
        ];

        return $dataSets;
    }
}
