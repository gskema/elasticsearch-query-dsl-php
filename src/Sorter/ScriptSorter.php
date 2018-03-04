<?php

namespace Gskema\ElasticSearchQueryDSL\Sorter;

use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-sort.html#_script_based_sorting
 * @see ScriptSorterTest
 */
class ScriptSorter implements SorterInterface
{
    /** @var string */
    protected $type;

    /** @var ScriptInterface */
    protected $script;

    /** @var string|null 'asc', 'desc' */
    protected $order;

    /** @var string|null 'min', 'max', 'sum', 'avg', 'median' */
    protected $mode;

    public function __construct(string $type, ScriptInterface $script)
    {
        $this->type = $type;
        $this->script = $script;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getScript(): ScriptInterface
    {
        return $this->script;
    }

    /**
     * @return string|null
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string|null $order
     *
     * @return $this
     */
    public function setOrder(string $order = null): ScriptSorter
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMode()
    {
        return $this->order;
    }

    /**
     * @param string|null $mode
     *
     * @return $this
     */
    public function setMode(string $mode = null): ScriptSorter
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
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
