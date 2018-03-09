<?php

namespace Gskema\ElasticSearchQueryDSL;

use stdClass;

class AbstractRawFragmentTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{ }',
            new RawFragment(new stdClass()),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            'null',
            new RawFragment(null),
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            'false',
            new RawFragment(false),
        ];

        // #3
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

        // #4
        $dataSets[] = [
            // language=JSON
            '1',
            new RawFragment(1),
        ];

        // #5
        $dataSets[] = [
            // language=JSON
            '"string"',
            new RawFragment('string'),
        ];

        // #6
        $dataSets[] = [
            // language=JSON
            '[1, 2, 3]',
            new RawFragment([1, 2, 3]),
        ];

        return $dataSets;
    }
}
