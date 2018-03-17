<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use UnexpectedValueException;

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
                    "reduce_script": "source4",
                    "params": {
                        "param2": "value2",
                        "param3": "value3"
                    }
                }
            }',
            (new ScriptedMetricAggregation())
                ->setInitScript(new InlineScript('source1'))
                ->setMapScript(new InlineScript('source2'))
                ->setCombineScript(new InlineScript('source3'))
                ->setReduceScript(new InlineScript('source4'))
                ->setParams([
                    'param1' => 'value1',
                    'param2' => 'value2',
                ])
                ->setParam('param3', 'value3')
                ->removeParam('param1'),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = (new ScriptedMetricAggregation())
            ->setInitScript(new InlineScript('source1'))
            ->setMapScript(new InlineScript('source2'))
            ->setCombineScript(new InlineScript('source3'))
            ->setReduceScript(new InlineScript('source4'))
            ->setParams([
                'param1' => 'value1',
                'param2' => 'value2',
            ])
            ->setParam('param3', 'value3')
            ->removeParam('param1');

        $this->assertEquals(new InlineScript('source1'), $agg->getInitScript());
        $this->assertEquals(new InlineScript('source2'), $agg->getMapScript());
        $this->assertEquals(new InlineScript('source3'), $agg->getCombineScript());
        $this->assertEquals(new InlineScript('source4'), $agg->getReduceScript());
        $this->assertEquals([
            'param2' => 'value2',
            'param3' => 'value3',
        ], $agg->getParams());
        $this->assertEquals(null, $agg->getParam('param1'));
        $this->assertEquals('value2', $agg->getParam('param2'));

        $this->expectException(UnexpectedValueException::class);
        (new ScriptedMetricAggregation())->jsonSerialize();
    }
}
