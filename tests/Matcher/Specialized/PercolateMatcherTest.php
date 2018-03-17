<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class PercolateMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "percolate": {
                    "field": "queryField1",
                    "document_type": "docType1",
                    "document": {
                        "body": "body1"
                    }
                }
            
            }',
            PercolateMatcher::fromDocSource(
                'queryField1',
                'docType1',
                [
                    'body' => 'body1'
                ]
            ),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "percolate": {
                    "field": "queryField1",
                    "document_type": "docType1",
                    "index": "index1",
                    "type": "type1",
                    "id": "id1"
                }
            
            }',
            PercolateMatcher::fromIndexedDoc(
                'queryField1',
                'docType1',
                'index1',
                'type1',
                'id1'
            ),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = PercolateMatcher::fromIndexedDoc(
            'queryField1',
            'docType1',
            'index1',
            'type1',
            'id1'
        );
        $this->assertInstanceOf(PercolateMatcher::class, $matcher1);
    }
}
