<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\Model\Script\ScriptInterface;
use UnexpectedValueException;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-aggregations-metrics-scripted-metric-aggregation.html
 * @see ScriptedMetricAggregationTest
 */
class ScriptedMetricAggregation implements MetricAggregationInterface
{
    public function __construct(
        protected ?ScriptInterface $initScript = null,
        protected ?ScriptInterface $mapScript = null,
        protected ?ScriptInterface $combineScript = null,
        protected ?ScriptInterface $reduceScript = null,
        /** @var array<string, mixed> */
        protected array $params = [],
    ) {
    }

    public function __clone()
    {
        $this->initScript = $this->initScript ? clone $this->initScript : null;
        $this->mapScript = $this->mapScript ? clone $this->mapScript : null;
        $this->combineScript = $this->combineScript ? clone $this->combineScript : null;
        $this->reduceScript = $this->reduceScript ? clone $this->reduceScript : null;
    }

    public function getInitScript(): ?ScriptInterface
    {
        return $this->initScript;
    }

    public function setInitScript(?ScriptInterface $initScript): static
    {
        $this->initScript = $initScript;
        return $this;
    }

    public function getMapScript(): ?ScriptInterface
    {
        return $this->mapScript;
    }

    public function setMapScript(?ScriptInterface $mapScript): static
    {
        $this->mapScript = $mapScript;
        return $this;
    }

    public function getCombineScript(): ?ScriptInterface
    {
        return $this->combineScript;
    }

    public function setCombineScript(?ScriptInterface $combineScript): static
    {
        $this->combineScript = $combineScript;
        return $this;
    }

    public function getReduceScript(): ?ScriptInterface
    {
        return $this->reduceScript;
    }

    public function setReduceScript(?ScriptInterface $reduceScript): static
    {
        $this->reduceScript = $reduceScript;
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return $this->params;
    }

    public function getParam(string $name): mixed
    {
        return $this->params[$name] ?? null;
    }

    /**
     * @param array<string, mixed> $paramsByName
     */
    public function setParams(array $paramsByName): static
    {
        $this->params = $paramsByName;
        return $this;
    }

    public function setParam(string $name, mixed $value): static
    {
        $this->params[$name] = $value;
        return $this;
    }

    public function removeParam(string $name): static
    {
        unset($this->params[$name]);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        if (null === $this->mapScript) {
            throw new UnexpectedValueException('Map script is required');
        }

        $body = [];
        if (null !== $this->initScript) {
            $body['init_script'] = $this->initScript->jsonSerialize();
        }
        $body['map_script'] = $this->mapScript->jsonSerialize();
        if (null !== $this->combineScript) {
            $body['combine_script'] = $this->combineScript->jsonSerialize();
        }
        if (null !== $this->reduceScript) {
            $body['reduce_script'] = $this->reduceScript->jsonSerialize();
        }
        if (!empty($this->params)) {
            $body['params'] = $this->params;
        }

        return [
            'scripted_metric' => $body,
        ];
    }
}
