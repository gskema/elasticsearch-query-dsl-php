<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use InvalidArgumentException;

final class PercentilesAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "percentiles": {
                    "script": "s1",
                    "percents": [1, 2, 3]
                }
            }',
            PercentilesAggregation::fromScript(new InlineScript('s1'), ['percents' => [1, 2, 3]]),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg1 = PercentilesAggregation::fromField('field1', ['percents' => [1, 2, 3]], new InlineScript('source1'));
        self::assertInstanceOf(PercentilesAggregation::class, $agg1);

        $agg2 = PercentilesAggregation::fromScript(new InlineScript('source1'), ['percents' => [1, 2, 3]]);
        self::assertInstanceOf(PercentilesAggregation::class, $agg2);
    }

    public function testConstructorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new class extends PercentilesAggregation {
            public function __construct()
            {
                parent::__construct(null, null);
            }
        };
    }
}
