<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Suggester\TermSuggester;
use PHPUnit\Framework\TestCase;

class HasSuggestersTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasSuggestersTrait $object */
        $object = $this->getMockBuilder(HasSuggestersTrait::class)->getMockForTrait();

        $object
            ->setSuggesters([
                'key1' => new TermSuggester('field1', 'text1'),
                'key2' => new TermSuggester('field2', 'text2'),
            ])
            ->setSuggester('key3', new TermSuggester('field3', 'text3'))
            ->removeSuggester('key1');

        $this->assertEquals(null, $object->getSuggester('key1'));
        $this->assertEquals(new TermSuggester('field2', 'text2'), $object->getSuggester('key2'));
        $this->assertEquals([
            'key2' => new TermSuggester('field2', 'text2'),
            'key3' => new TermSuggester('field3', 'text3'),
        ], $object->getSuggesters());
    }
}
