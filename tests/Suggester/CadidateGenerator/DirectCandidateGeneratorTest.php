<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Suggester\CandidateGenerator\DirectCandidateGenerator;

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
}
