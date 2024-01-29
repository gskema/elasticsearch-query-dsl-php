<?php

namespace Gskema\ElasticsearchQueryDSL;

use Gskema\ElasticsearchQueryDSL\Aggregation\Bucket\GlobalAggregation;
use Gskema\ElasticsearchQueryDSL\Aggregation\EmptyAggregation;
use PHPUnit\Framework\TestCase;

final class HasAggsTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasAggsTrait $givenObject */
        $givenObject = new class {
            use HasAggsTrait;
        };

        self::assertEquals(false, $givenObject->hasAggs());
        self::assertEquals(false, $givenObject->hasAgg('key1'));

        $givenObject->setAggs(['key1' => new GlobalAggregation()]);
        $givenObject->setAgg('key2', new EmptyAggregation('stats'));

        self::assertEquals(true, $givenObject->hasAggs());
        self::assertEquals(true, $givenObject->hasAgg('key1'));
        self::assertEquals(true, $givenObject->hasAgg('key2'));
        self::assertEquals(false, $givenObject->hasAgg('key3'));

        self::assertEquals(new GlobalAggregation(), $givenObject->getAgg('key1'));
        self::assertEquals(new EmptyAggregation('stats'), $givenObject->getAgg('key2'));
        self::assertEquals([
            'key1' => new GlobalAggregation(),
            'key2' => new EmptyAggregation('stats'),
        ], $givenObject->getAggs());

        $givenObject->removeAgg('key2');
        self::assertEquals(['key1' => new GlobalAggregation()], $givenObject->getAggs());

        $givenObject->removeAggs();
        self::assertEquals([], $givenObject->getAggs());
    }
}
