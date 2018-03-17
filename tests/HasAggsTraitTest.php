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

        $this->assertEquals($givenObject->hasAggs(), false);
        $this->assertEquals($givenObject->hasAgg('key1'), false);;

        $givenObject->setAggs(['key1' => new GlobalAggregation()]);
        $givenObject->setAgg('key2', new EmptyAggregation('stats'));

        $this->assertEquals($givenObject->hasAggs(), true);
        $this->assertEquals($givenObject->hasAgg('key1'), true);
        $this->assertEquals($givenObject->hasAgg('key2'), true);
        $this->assertEquals($givenObject->hasAgg('key3'), false);

        $this->assertEquals($givenObject->getAgg('key1'), new GlobalAggregation());
        $this->assertEquals($givenObject->getAgg('key2'), new EmptyAggregation('stats'));
        $this->assertEquals($givenObject->getAggs(), [
            'key1' => new GlobalAggregation(),
            'key2' => new EmptyAggregation('stats'),
        ]);

        $givenObject->removeAgg('key2');
        $this->assertEquals($givenObject->getAggs(), ['key1' => new GlobalAggregation()]);

        $givenObject->removeAggs();
        $this->assertEquals($givenObject->getAggs(), []);
    }
}
