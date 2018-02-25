<?php

namespace Gskema\ElasticSearchQueryDSL\Highlighter;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class HighlighterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        $dataSets[] = [
            // language=JSON
            '{
                "fields": {
                    "field1": {}
                }
            }',
            (new Highlighter())->setField('field1'),
        ];

        $dataSets[] = [
            // language=JSON
            '{
                "type": "plain",
                "fields": {
                    "field1": {}
                }
            }',
            (new Highlighter(['type' => 'plain']))->setField('field1'),
        ];

        $dataSets[] = [
            // language=JSON
            '{
                "type": "plain",
                "fields": {
                    "field1": {
                        "order": "score"
                    }
                }
            }',
            (new Highlighter(['type' => 'plain']))->setField('field1', ['order' => 'score']),
        ];

        return $dataSets;
    }
}
