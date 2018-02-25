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

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->body;
    }
}
