<?php

namespace Gskema\ElasticSearchQueryDSL;

/**
 * @see HasOptionsTraitTest
 */
trait HasOptionsTrait
{
    /** @var array */
    protected $options = [];

    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function getOption(string $key)
    {
        return $this->options[$key] ?? null;
    }

    /**
     * @param array $optionsByKey
     *
     * @return $this
     */
    public function setOptions(array $optionsByKey)
    {
        $this->options = $optionsByKey;

        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function setOption(string $key, $value)
    {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function removeOptions()
    {
        $this->options = [];

        return $this;
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function removeOption(string $key)
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
