<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\Suggester\CandidateGenerator\DirectCandidateGenerator;

class PhraseSuggesterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "text": "text1",
                "phrase": {
                    "field": "field1"
                }
            }',
            (new PhraseSuggester('field1', 'text1')),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "text": "text1",
                    "phrase": {
                        "field": "field1",
                        "direct_generator": [
                            { "field": "field1" }
                        ],
                        "collate": {
                          "query": { "match_all": {} },
                          "params": {
                            "param1": "value1"
                          },
                          "prune": true
                        }
                    }
            }',
            (new PhraseSuggester('field1', 'text1'))
                ->addDirectGenerator(new DirectCandidateGenerator('field1'))
                ->setCollate(new MatchAllMatcher(), ['param1' => 'value1'], true),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $suggester = (new PhraseSuggester('field1', 'text1', ['key1' => 'value1']))
            ->setDirectGenerators([
                new DirectCandidateGenerator('field1')
            ])
            ->addDirectGenerator(new DirectCandidateGenerator('field2'))
            ->setCollate(new MatchAllMatcher(), ['param1' => 'value1'], true);

        $this->assertInstanceOf(PhraseSuggester::class, $suggester);
        $this->assertEquals([
            new DirectCandidateGenerator('field1'),
            new DirectCandidateGenerator('field2'),
        ], $suggester->getDirectGenerators());
    }
}
