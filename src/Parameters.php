<?php

namespace Gskema\ElasticSearchQueryDSL;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Parameters
{
    public function __construct(
        /** @var array<string, mixed> */
        public readonly array $parameters,
    ) {
    }
}
