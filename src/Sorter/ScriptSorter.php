<?php

namespace Gskema\ElasticsearchQueryDSL\Sorter;

use Gskema\ElasticsearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-sort.html#_script_based_sorting
 * @see ScriptSorterTest
 */
class ScriptSorter implements SorterInterface
{
    public function __construct(
        protected string $type,
        protected ScriptInterface $script, // 'asc', 'desc'
        protected ?string $order = null,
        protected ?string $mode = null, // 'min', 'max', 'sum', 'avg', 'median'
    ) {
    }

    public function __clone()
    {
        $this->script = clone $this->script;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getScript(): ScriptInterface
    {
        return $this->script;
    }

    public function getOrder(): ?string
    {
        return $this->order;
    }

    public function setOrder(?string $order): static
    {
        $this->order = $order;
        return $this;
    }

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(?string $mode): static
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $body = [];
        $body['type'] = $this->type;
        $body['script'] = $this->script->jsonSerialize();

        if (null !== $this->order) {
            $body['order'] = $this->order;
        }
        if (null !== $this->mode) {
            $body['mode'] = $this->mode;
        }

        return [
            '_script' => $body,
        ];
    }
}
