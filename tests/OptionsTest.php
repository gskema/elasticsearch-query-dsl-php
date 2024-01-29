<?php

namespace Gskema\ElasticsearchQueryDSL;

use PHPUnit\Framework\TestCase;

final class OptionsTest extends TestCase
{
    public function testMethods(): void
    {
        $object = new Options(['param1' => 1]);
        self::assertEquals(['param1' => 1], $object->values);
    }
}
