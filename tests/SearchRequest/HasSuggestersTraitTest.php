<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\Suggester\TermSuggester;
use PHPUnit\Framework\TestCase;

final class HasSuggestersTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasSuggestersTrait $object */
        $object = new class {
            use HasSuggestersTrait;
        };

        $object
            ->setSuggesters([
                'key1' => new TermSuggester('field1', 'text1'),
                'key2' => new TermSuggester('field2', 'text2'),
            ])
            ->setSuggester('key3', new TermSuggester('field3', 'text3'))
            ->removeSuggester('key1');

        self::assertEquals(null, $object->getSuggester('key1'));
        self::assertEquals(new TermSuggester('field2', 'text2'), $object->getSuggester('key2'));
        self::assertEquals([
            'key2' => new TermSuggester('field2', 'text2'),
            'key3' => new TermSuggester('field3', 'text3'),
        ], $object->getSuggesters());
    }
}
