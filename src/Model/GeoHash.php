<?php

namespace Gskema\ElasticSearchQueryDSL\Model;

/**
 * @see GeoHashTest
 */
class GeoHash implements GeoPointInterface
{
    /** @var string */
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
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
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->value;
    }
}
