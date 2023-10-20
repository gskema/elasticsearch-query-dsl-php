<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class TermSuggesterTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "text": "text1",
                "term": {
                    "field": "field1"
                }
            }',
            (new TermSuggester('field1', 'text1')),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "text": "text1",
                "term": {
                    "field": "field1",
                    "shard_size": 5
                }
            }',
            (new TermSuggester('field1', 'text1'))->setOption('shard_size', 5),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $suggester = (new TermSuggester('field1', 'text1'))->setOption('shard_size', 5);

        self::assertInstanceOf(TermSuggester::class, $suggester);
        self::assertEquals(5, $suggester->getOption('shard_size'));
    }
}
