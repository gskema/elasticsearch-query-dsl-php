<?php

namespace Gskema\ElasticSearchQueryDSL;

/**
 * @see HasParametersTraitTest
 */
trait HasParametersTrait
{
    /** @var array<string, mixed> */
    protected array $parameters = [];

    /**
     * @return array<string, mixed>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getParameter(string $key): mixed
    {
        return $this->parameters[$key] ?? null;
    }

    /**
     * @param array<string, mixed> $parameters
     */
    public function setParameters(array $parameters): static
    {
        $this->parameters = $parameters;
        return $this;
    }

    public function setParameter(string $key, mixed $value): static
    {
        $this->parameters[$key] = $value;
        return $this;
    }

    public function removeParameters(): static
    {
        $this->parameters = [];
        return $this;
    }

    public function removeParameter(string $key): static
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
