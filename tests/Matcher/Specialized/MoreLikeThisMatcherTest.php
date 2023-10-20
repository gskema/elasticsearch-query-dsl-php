<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class MoreLikeThisMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $matcher1 = new MoreLikeThisMatcher(
            ['field1', 'field2'],
            'like1',
            [
                'min_term_freq' => 5,
                'max_doc_freq' => 0,
            ]
        );
        self::assertInstanceOf(MoreLikeThisMatcher::class, $matcher1);
    }
}
