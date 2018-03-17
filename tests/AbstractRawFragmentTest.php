<?php

namespace Gskema\ElasticSearchQueryDSL;

use ReflectionClass;
use stdClass;

abstract class AbstractRawFragmentTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $className = substr((new ReflectionClass($this))->getName(), 0, -4);

        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{ }',
            new $className(new stdClass()),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            'null',
            new $className(null),
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            'false',
            new $className(false),
        ];

        // #3
        $dataSets[] = [
            // language=JSON
            '{
                "term": {
                    "user": "Jonas"
                }
            }',
            new $className([
                'term' => [
                    'user' => 'Jonas',
                ],
            ]),
        ];

        // #4
        $dataSets[] = [
            // language=JSON
            '1',
            new $className(1),
        ];

        // #5
        $dataSets[] = [
            // language=JSON
            '"string"',
            new $className('string'),
        ];

        // #6
        $dataSets[] = [
            // language=JSON
            '[1, 2, 3]',
            new $className([1, 2, 3]),
        ];

        return $dataSets;
    }
}
