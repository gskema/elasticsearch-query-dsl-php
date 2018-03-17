<?php

namespace Gskema\ElasticSearchQueryDSL;

use Gskema\ElasticSearchQueryDSL\Aggregation\Bucket\GlobalAggregation;
use Gskema\ElasticSearchQueryDSL\Aggregation\EmptyAggregation;
use PHPUnit\Framework\TestCase;

class HasAggsTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasAggsTrait $givenObject */
        $givenObject = $this
            ->getMockBuilder(HasAggsTrait::class)
            ->setMethods(null)
            ->getMockForTrait();

        $this->assertEquals(false, $givenObject->hasAggs());
        $this->assertEquals(false, $givenObject->hasAgg('key1'));

        $givenObject->setAggs(['key1' => new GlobalAggregation()]);
        $givenObject->setAgg('key2', new EmptyAggregation('stats'));

        $this->assertEquals(true, $givenObject->hasAggs());
        $this->assertEquals(true, $givenObject->hasAgg('key1'));
        $this->assertEquals(true, $givenObject->hasAgg('key2'));
        $this->assertEquals(false, $givenObject->hasAgg('key3'));

        $this->assertEquals(new GlobalAggregation(), $givenObject->getAgg('key1'));
        $this->assertEquals(new EmptyAggregation('stats'), $givenObject->getAgg('key2'));
        $this->assertEquals([
            'key1' => new GlobalAggregation(),
            'key2' => new EmptyAggregation('stats'),
        ], $givenObject->getAggs());

        $givenObject->removeAgg('key2');
        $this->assertEquals(['key1' => new GlobalAggregation()], $givenObject->getAggs());

        $givenObject->removeAggs();
        $this->assertEquals([], $givenObject->getAggs());
    }
}
