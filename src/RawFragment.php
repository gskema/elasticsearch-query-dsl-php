<?php

namespace Gskema\ElasticSearchQueryDSL;

use JsonSerializable;

/**
 * @see RawFragmentTest
 */
class RawFragment implements JsonSerializable
{
    public function __construct(protected mixed $body)
    {
    }

    public function __clone()
    {
        if (is_object($this->body)) {
            $this->body = clone $this->body;
        } elseif (is_array($this->body)) {
            $this->body = array_clone($this->body);
        }
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return $this->body;
    }
}
