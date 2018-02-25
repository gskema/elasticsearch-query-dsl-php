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
}
