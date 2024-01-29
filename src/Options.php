<?php

namespace Gskema\ElasticsearchQueryDSL;

use Attribute;

/**
 * @see OptionsTest
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Options
{
    public function __construct(
        /** @var array<string, mixed> */
        public readonly array $values,
    ) {
    }
}
