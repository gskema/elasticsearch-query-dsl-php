<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester\CandidateGenerator;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class DirectCandidateGeneratorTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "field": "field1"
            }',
            new DirectCandidateGenerator('field1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "field": "field1",
                "size": 1
            }',
            new DirectCandidateGenerator('field1', ['size' => 1]),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $generator = new DirectCandidateGenerator('field1', ['size' => 1]);

        self::assertInstanceOf(DirectCandidateGenerator::class, $generator);
    }
}
