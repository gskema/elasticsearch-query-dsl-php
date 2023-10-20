<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester\ContextQuery;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class CategoryContextQueryTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '["category1"]',
            (new CategoryContextQuery())->addCategory('category1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '["category1", "category2"]',
            (new CategoryContextQuery())
                ->addCategory('category1')
                ->addCategory('category2'),
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            '[
                { "context": "category1", "boost": 1.1 },
                { "context": "category2", "boost": 1.2 }
            ]',
            (new CategoryContextQuery())
                ->addCategory('category1', 1.1)
                ->addCategory('category2', 1.2),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $ctxQuery = (new CategoryContextQuery())
            ->addCategory('category1', 1.1, 'prefix1');

        self::assertInstanceOf(CategoryContextQuery::class, $ctxQuery);
    }
}
