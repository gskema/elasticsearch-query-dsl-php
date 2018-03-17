<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;
use PHPUnit\Framework\TestCase;

class HasScriptFieldsTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasScriptFieldsTrait $object */
        $object = $this->getMockBuilder(HasScriptFieldsTrait::class)->getMockForTrait();

        $object->setScriptFields([
            'field1' => new InlineScript('source1'),
            'field2' => new InlineScript('source2'),
        ]);
        $object->setScriptField('field3', new InlineScript('source3'));
        $object->removeScriptField('field1');

        $this->assertEquals([
            'field2' => new InlineScript('source2'),
            'field3' => new InlineScript('source3'),
        ], $object->getScriptFields());

        $this->assertEquals(new InlineScript('source3'), $object->getScriptField('field3'));
    }
}
