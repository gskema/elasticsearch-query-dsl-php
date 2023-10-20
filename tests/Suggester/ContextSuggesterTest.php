<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Suggester\ContextQuery\CategoryContextQuery;

final class ContextSuggesterTest extends AbstractJsonSerializeTestCase
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
                        "field": "field1",
                            "contexts": {
                                "context1": ["category1"]
                            }
                        }
            }',
            ContextSuggester::fromPrefix('field1', 'prefix1')
                ->setContext(
                    'context1',
                    (new CategoryContextQuery())->addCategory('category1')
                ),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "regex": "regex1",
                    "completion": {
                        "field": "field1",
                        "contexts": {
                            "context1": ["category1"],
                            "context2": ["category1", "category2"]
                        }
                    }
            }',
            ContextSuggester::fromRegex('field1', 'regex1')
                ->setContext(
                    'context1',
                    (new CategoryContextQuery())->addCategory('category1')
                )
                ->setContext(
                    'context2',
                    (new CategoryContextQuery())
                        ->addCategory('category1')
                        ->addCategory('category2')
                ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $suggester1 = ContextSuggester::fromPrefix('field1', 'prefix1')
            ->setContexts([
                'ctx1' => (new CategoryContextQuery())->addCategory('cat1'),
                'ctx2' => (new CategoryContextQuery())->addCategory('cat2'),
            ])
            ->setContext('ctx3', (new CategoryContextQuery())->addCategory('cat3'))
            ->removeContext('ctx1');

        self::assertInstanceOf(CompletionSuggester::class, $suggester1);
        self::assertEquals(null, $suggester1->getContext('ctx1'));
        self::assertEquals(
            (new CategoryContextQuery())->addCategory('cat2'),
            $suggester1->getContext('ctx2')
        );
        self::assertEquals(
            [
                'ctx2' => (new CategoryContextQuery())->addCategory('cat2'),
                'ctx3' => (new CategoryContextQuery())->addCategory('cat3'),
            ],
            $suggester1->getContexts()
        );

        $suggester2 = ContextSuggester::fromRegex('field1', 'regex1');
        self::assertInstanceOf(CompletionSuggester::class, $suggester2);
    }
}
