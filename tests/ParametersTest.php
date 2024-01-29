<?php

namespace Gskema\ElasticsearchQueryDSL;

use PHPUnit\Framework\TestCase;

final class ParametersTest extends TestCase
{
    public function testMethods(): void
    {
        $object = new Parameters(['param1' => 1]);
        self::assertEquals(['param1' => 1], $object->values);
    }
}
