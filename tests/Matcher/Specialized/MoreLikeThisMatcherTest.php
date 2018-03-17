<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MoreLikeThisMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "more_like_this": {
                    "fields": ["field1", "field2"],
                    "like": "like1",
                    "min_term_freq": 5,
                    "max_doc_freq": 0
                }
            }',
            new MoreLikeThisMatcher(
                ['field1', 'field2'],
                'like1',
                [
                    'min_term_freq' => 5,
                    'max_doc_freq' => 0,
                ]
            ),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new MoreLikeThisMatcher(
            ['field1', 'field2'],
            'like1',
            [
                'min_term_freq' => 5,
                'max_doc_freq' => 0,
            ]
        );
        $this->assertInstanceOf(MoreLikeThisMatcher::class, $matcher1);
    }
}
