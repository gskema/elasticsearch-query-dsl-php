<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester\ContextQuery;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class CategoryContextQueryTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
}
