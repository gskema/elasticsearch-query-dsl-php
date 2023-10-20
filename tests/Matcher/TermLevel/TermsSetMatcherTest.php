<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

final class TermsSetMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "terms_set": {
                    "field1": {
                      "terms": ["value1", "value2"],
                      "minimum_should_match_field": "field2"
                    }
                }
            }',
            new TermsSetMatcher('field1', ['value1', 'value2'], 'field2'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "terms_set": {
                    "field1": {
                      "terms": ["value1", "value2"],
                      "minimum_should_match_script": "field2"
                    }
                }
            }',
            new TermsSetMatcher('field1', ['value1', 'value2'], new InlineScript('field2')),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new TermsSetMatcher('field1', ['value1', 'value2'], 'field2');
        self::assertInstanceOf(TermsSetMatcher::class, $matcher1);
    }
}
