<?php

namespace Gskema\ElasticsearchQueryDSL;

/**
 * @see HasOptionsTraitTest
 */
trait HasOptionsTrait
{
    /** @var array<string, mixed> */
    protected array $options = [];

    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    public function getOption(string $key): mixed
    {
        return $this->options[$key] ?? null;
    }

    /**
     * @param array<string, mixed> $optionsByKey
     */
    public function setOptions(array $optionsByKey): static
    {
        $this->options = $optionsByKey;
        return $this;
    }

    public function setOption(string $key, mixed $value): static
    {
        $this->options[$key] = $value;
        return $this;
    }

    public function removeOptions(): static
    {
        $this->options = [];
        return $this;
    }

    public function removeOption(string $key): static
    {
        unset($this->options[$key]);
        return $this;
    }

    public function hasOptions(): bool
    {
        return !empty($this->options);
    }

    public function hasOption(string $key): bool
    {
        return key_exists($key, $this->options);
    }
}
