<?php

namespace Gskema\ElasticSearchQueryDSL\FieldCollapser;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHitsRequest;

class FieldCollapserTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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

    public function testMethods()
    {
        $givenCollapser = new FieldCollapser('field1');

        $this->assertEquals('field1', $givenCollapser->getField());
        $this->assertEquals([], $givenCollapser->getInnerHits());

        $givenCollapser->setInnerHits([
            (new InnerHitsRequest())->setName('name1'),
            (new InnerHitsRequest())->setName('name2'),
        ]);
        $givenCollapser->addInnerHits((new InnerHitsRequest())->setName('name3'));

        $this->assertEquals([
            (new InnerHitsRequest())->setName('name1'),
            (new InnerHitsRequest())->setName('name2'),
            (new InnerHitsRequest())->setName('name3'),
        ], $givenCollapser->getInnerHits());
    }
}
