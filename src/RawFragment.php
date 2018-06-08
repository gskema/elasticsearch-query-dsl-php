<?php

namespace Gskema\ElasticSearchQueryDSL;

use JsonSerializable;

/**
 * @see RawFragmentTest
 */
class RawFragment implements JsonSerializable
{
    /** @var mixed */
    protected $body;

    /**
     * @param mixed $body
     */
    public function __construct($body)
    {
        $this->body = $body;
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
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->body;
    }
}
