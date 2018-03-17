<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Specialized;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class TemplateMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "template": {
                    "source": "source1",
                    "params": {
                        "param1": "value1"
                    }
                }
            }',
            TemplateMatcher::fromSource(
                'source1',
                [
                    'param1' => 'value1'
                ]
            ),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "template": {
                    "file": "file1",
                    "params": {
                        "param1": "value1"
                    }
                }
            }',
            TemplateMatcher::fromFile(
                'file1',
                [
                    'param1' => 'value1'
                ]
            ),
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            '{
                "template": {
                    "id": "templateId1",
                    "params": {
                        "param1": "value1"
                    }
                }
            }',
            TemplateMatcher::fromId(
                'templateId1',
                [
                    'param1' => 'value1'
                ]
            ),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = TemplateMatcher::fromId(
            'templateId1',
            [
                'param1' => 'value1'
            ]
        );
        $this->assertInstanceOf(TemplateMatcher::class, $matcher1);
    }
}
