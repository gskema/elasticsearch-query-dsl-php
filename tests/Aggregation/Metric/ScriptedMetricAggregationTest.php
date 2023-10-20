<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use UnexpectedValueException;

final class ScriptedMetricAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
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

        self::assertEquals(new InlineScript('source1'), $agg->getInitScript());
        self::assertEquals(new InlineScript('source2'), $agg->getMapScript());
        self::assertEquals(new InlineScript('source3'), $agg->getCombineScript());
        self::assertEquals(new InlineScript('source4'), $agg->getReduceScript());
        self::assertEquals([
            'param2' => 'value2',
            'param3' => 'value3',
        ], $agg->getParams());
        self::assertEquals(null, $agg->getParam('param1'));
        self::assertEquals('value2', $agg->getParam('param2'));

        $this->expectException(UnexpectedValueException::class);
        (new ScriptedMetricAggregation())->jsonSerialize();
    }
}
