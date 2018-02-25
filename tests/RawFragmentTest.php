<?php

namespace Gskema\ElasticSearchQueryDSL;

use stdClass;

class RawFragmentTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        $dataSets[] = [
            // language=JSON
            '{ }',
            new RawFragment(new stdClass()),
        ];

        $dataSets[] = [
            // language=JSON
            'null',
            new RawFragment(null),
        ];

        $dataSets[] = [
            // language=JSON
            'false',
            new RawFragment(false),
        ];

        $dataSets[] = [
            // language=JSON
            '{
                "term": {
                    "user": "Jonas"
                }
            }',
            new RawFragment([
                'term' => [
                    'user' => 'Jonas',
                ],
            ]),
        ];

        return $dataSets;
    }
}
