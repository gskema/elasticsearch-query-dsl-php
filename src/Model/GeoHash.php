<?php

namespace Gskema\ElasticSearchQueryDSL\Model;

/**
 * @see GeoHashTest
 */
class GeoHash implements GeoPointInterface
{
    public function __construct(protected string $value)
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return $this->value;
    }
}
