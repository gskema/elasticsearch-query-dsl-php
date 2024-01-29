<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\Model\Script\InlineScript;
use PHPUnit\Framework\TestCase;

final class HasScriptFieldsTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasScriptFieldsTrait $object */
        $object = new class {
            use HasScriptFieldsTrait;
        };

        $object->setScriptFields([
            'field1' => new InlineScript('source1'),
            'field2' => new InlineScript('source2'),
        ]);
        $object->setScriptField('field3', new InlineScript('source3'));
        $object->removeScriptField('field1');

        self::assertEquals([
            'field2' => new InlineScript('source2'),
            'field3' => new InlineScript('source3'),
        ], $object->getScriptFields());

        self::assertEquals(new InlineScript('source3'), $object->getScriptField('field3'));
    }
}
