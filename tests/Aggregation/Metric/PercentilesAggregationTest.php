<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class PercentilesAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "percentiles": {
                    "field": "field1",
                    "percents": [1, 2, 3]
                }
            }',
            PercentilesAggregation::fromField('field1', ['percents' => [1, 2, 3]]),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg1 = PercentilesAggregation::fromField('field1', ['percents' => [1, 2, 3]], new InlineScript('source1'));
        $this->assertInstanceOf(PercentilesAggregation::class, $agg1);

        $agg2 = PercentilesAggregation::fromScript(new InlineScript('source1'), ['percents' => [1, 2, 3]]);
        $this->assertInstanceOf(PercentilesAggregation::class, $agg2);
    }
}
