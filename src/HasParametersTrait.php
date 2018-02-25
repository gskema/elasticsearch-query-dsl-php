<?php

namespace Gskema\ElasticSearchQueryDSL;

trait HasParametersTrait
{
    /** @var array */
    protected $parameters = [];

    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function getParameter(string $key)
    {
        return $this->parameters[$key] ?? null;
    }

    /**
     * @param array $parameters
     *
     * @return $this
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function setParameter(string $key, $value)
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function removeParameters()
    {
        $this->parameters = [];

        return $this;
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function removeParameter(string $key)
    {
        unset($this->parameters[$key]);

        return $this;
    }

    public function hasParameters(): bool
    {
        return !empty($this->parameters);
    }

    public function hasParameter(string $key): bool
    {
        return key_exists($key, $this->parameters);
    }
}
