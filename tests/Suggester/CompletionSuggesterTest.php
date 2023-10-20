<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class CompletionSuggesterTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "prefix": "prefix1",
                "completion": {
                    "field": "field1"
                }
            }',
            CompletionSuggester::fromPrefix('field1', 'prefix1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "regex": "regex1",
                "completion": {
                    "field": "field1"
                }
            }',
            CompletionSuggester::fromRegex('field1', 'regex1'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $suggester1 = CompletionSuggester::fromPrefix('field1', 'prefix1');
        self::assertInstanceOf(CompletionSuggester::class, $suggester1);

        $suggester2 = CompletionSuggester::fromRegex('field1', 'regex1');
        self::assertInstanceOf(CompletionSuggester::class, $suggester2);
    }
}
