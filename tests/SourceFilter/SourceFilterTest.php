<?php

namespace Gskema\ElasticSearchQueryDSL\SourceFilter;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class SourceFilterTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{ }',
            new SourceFilter()
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '"field1"',
            (new SourceFilter())->addInclude('field1')
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            '["field1","field2"]',
            (new SourceFilter())->addInclude('field1')->addInclude('field2')
        ];

        // #3
        $dataSets[] = [
            // language=JSON
            '{
                "includes": "field1",
                "excludes": "field2"
            }',
            (new SourceFilter())->addInclude('field1')->addExclude('field2')
        ];

        // #4
        $dataSets[] = [
            // language=JSON
            '{
                "excludes": "field2"
            }',
            (new SourceFilter())->addExclude('field2')
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $filter = (new SourceFilter())
            ->setIncludes(['inc1', 'inc2'])
            ->setExcludes(['exc1', 'exc2'])
            ->addInclude('inc3')
            ->addExclude('exc3');

        self::assertEquals(['inc1', 'inc2', 'inc3'], $filter->getIncludes());
        self::assertEquals(['exc1', 'exc2', 'exc3'], $filter->getExcludes());
    }
}
