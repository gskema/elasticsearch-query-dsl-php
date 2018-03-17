<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester\CandidateGenerator;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class DirectCandidateGeneratorTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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

    public function testMethods()
    {
        $generator = new DirectCandidateGenerator('field1', ['size' => 1]);

        $this->assertInstanceOf(DirectCandidateGenerator::class, $generator);
    }
}
