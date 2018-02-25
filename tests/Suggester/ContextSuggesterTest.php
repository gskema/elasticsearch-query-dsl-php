<?php

namespace Gskema\ElasticSearchQueryDSL;

use Gskema\ElasticSearchQueryDSL\Suggester\ContextQuery\CategoryContextQuery;
use Gskema\ElasticSearchQueryDSL\Suggester\ContextSuggester;

class ContextSuggesterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
}
