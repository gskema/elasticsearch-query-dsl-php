<?php

namespace Gskema\ElasticsearchQueryDSL;

use Attribute;

/**
 * @see ParametersTest
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Parameters
{
    public function __construct(
        /** @var array<string, mixed> */
        public readonly array $values,
    ) {
    }
}
