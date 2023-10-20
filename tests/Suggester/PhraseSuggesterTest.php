<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\Suggester\CandidateGenerator\DirectCandidateGenerator;

final class PhraseSuggesterTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $suggester = (new PhraseSuggester('field1', 'text1', ['key1' => 'value1']))
            ->setDirectGenerators([
                new DirectCandidateGenerator('field1')
            ])
            ->addDirectGenerator(new DirectCandidateGenerator('field2'))
            ->setCollate(new MatchAllMatcher(), ['param1' => 'value1'], true);

        self::assertInstanceOf(PhraseSuggester::class, $suggester);
        self::assertEquals([
            new DirectCandidateGenerator('field1'),
            new DirectCandidateGenerator('field2'),
        ], $suggester->getDirectGenerators());
    }
}
