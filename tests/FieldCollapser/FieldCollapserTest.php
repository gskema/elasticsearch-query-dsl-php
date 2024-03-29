<?php

namespace Gskema\ElasticsearchQueryDSL\FieldCollapser;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\SearchRequest\InnerHits\InnerHitsRequest;

final class FieldCollapserTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        $dataSets[] = [
            // language=JSON
            '{
                "field": "field1"
            }',
            (new FieldCollapser('field1'))
        ];

        $dataSets[] = [
            // language=JSON
            '{
                "field": "field1",
                "inner_hits": {}
            }',
            (new FieldCollapser('field1'))->addInnerHits(new InnerHitsRequest())
        ];

        $dataSets[] = [
            // language=JSON
            '{
                "field": "field1",
                "inner_hits": [{}, {}]
            }',
            (new FieldCollapser('field1'))->setInnerHits([
                new InnerHitsRequest(),
                new InnerHitsRequest(),
            ])
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $givenCollapser = new FieldCollapser('field1');

        self::assertEquals('field1', $givenCollapser->getField());
        self::assertEquals([], $givenCollapser->getInnerHits());

        $givenCollapser->setInnerHits([
            (new InnerHitsRequest())->setName('name1'),
            (new InnerHitsRequest())->setName('name2'),
        ]);
        $givenCollapser->addInnerHits((new InnerHitsRequest())->setName('name3'));

        self::assertEquals([
            (new InnerHitsRequest())->setName('name1'),
            (new InnerHitsRequest())->setName('name2'),
            (new InnerHitsRequest())->setName('name3'),
        ], $givenCollapser->getInnerHits());
    }
}
