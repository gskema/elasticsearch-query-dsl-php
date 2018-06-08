<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\Model\Script\ScriptInterface;
use UnexpectedValueException;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-aggregations-metrics-scripted-metric-aggregation.html
 * @see ScriptedMetricAggregationTest
 */
class ScriptedMetricAggregation implements MetricAggregationInterface
{
    /** @var ScriptInterface|null */
    protected $initScript;

    /** @var ScriptInterface|null */
    protected $mapScript;

    /** @var ScriptInterface|null */
    protected $combineScript;

    /** @var ScriptInterface|null */
    protected $reduceScript;

    /** @var array */
    protected $params = [];

    public function __clone()
    {
        $this->initScript = $this->initScript ? clone $this->initScript : null;
        $this->mapScript = $this->mapScript ? clone $this->mapScript : null;
        $this->combineScript = $this->combineScript ? clone $this->combineScript : null;
        $this->reduceScript = $this->reduceScript ? clone $this->reduceScript : null;
    }

    /**
     * @return ScriptInterface|null
     */
    public function getInitScript()
    {
        return $this->initScript;
    }

    /**
     * @param ScriptInterface|null $initScript
     *
     * @return $this
     */
    public function setInitScript(ScriptInterface $initScript = null): ScriptedMetricAggregation
    {
        $this->initScript = $initScript;

        return $this;
    }

    /**
     * @return ScriptInterface|null
     */
    public function getMapScript()
    {
        return $this->mapScript;
    }

    /**
     * @param ScriptInterface|null $mapScript
     *
     * @return $this
     */
    public function setMapScript(ScriptInterface $mapScript = null): ScriptedMetricAggregation
    {
        $this->mapScript = $mapScript;

        return $this;
    }

    /**
     * @return ScriptInterface|null
     */
    public function getCombineScript()
    {
        return $this->combineScript;
    }

    /**
     * @param ScriptInterface|null $combineScript
     *
     * @return $this
     */
    public function setCombineScript(ScriptInterface $combineScript = null): ScriptedMetricAggregation
    {
        $this->combineScript = $combineScript;

        return $this;
    }

    /**
     * @return ScriptInterface|null
     */
    public function getReduceScript()
    {
        return $this->reduceScript;
    }

    /**
     * @param ScriptInterface|null $reduceScript
     *
     * @return $this
     */
    public function setReduceScript(ScriptInterface $reduceScript = null): ScriptedMetricAggregation
    {
        $this->reduceScript = $reduceScript;

        return $this;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param string $name
     *
     * @return mixed|null
     */
    public function getParam(string $name)
    {
        return $this->params[$name] ?? null;
    }

    /**
     * @param array $paramsByName
     *
     * @return $this
     */
    public function setParams(array $paramsByName): ScriptedMetricAggregation
    {
        $this->params = $paramsByName;

        return $this;
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function setParam(string $name, $value): ScriptedMetricAggregation
    {
        $this->params[$name] = $value;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function removeParam(string $name): ScriptedMetricAggregation
    {
        unset($this->params[$name]);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
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
