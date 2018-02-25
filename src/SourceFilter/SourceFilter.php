<?php

namespace Gskema\ElasticSearchQueryDSL\SourceFilter;

use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/search-request-source-filtering.html
 * @see SourceFilterTest
 */
class SourceFilter implements SourceFilterInterface
{
    /** @var string[] */
    protected $includes = [];

    /** @var string[] */
    protected $excludes = [];

    /**
     * @return string[]
     */
    public function getIncludes(): array
    {
        return $this->includes;
    }

    /**
     * @param string[] $includes
     *
     * @return SourceFilter
     */
    public function setIncludes(array $includes): SourceFilter
    {
        $this->includes = $includes;

        return $this;
    }

    /**
     * @param string $includedField
     *
     * @return SourceFilter
     */
    public function addInclude(string $includedField): SourceFilter
    {
        $this->includes[] = $includedField;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getExcludes(): array
    {
        return $this->excludes;
    }

    /**
     * @param string[] $excludes
     *
     * @return SourceFilter
     */
    public function setExcludes(array $excludes): SourceFilter
    {
        $this->excludes = $excludes;

        return $this;
    }

    /**
     * @param string $excludedField
     *
     * @return SourceFilter
     */
    public function addExclude(string $excludedField): SourceFilter
    {
        $this->excludes[] = $excludedField;

        return $this;
    }

    public function isEmpty(): bool
    {
        return empty($this->includes) && empty($this->excludes);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $includes = 1 === count($this->includes) ? $this->includes[0] : $this->includes;
        $excludes = 1 === count($this->excludes) ? $this->excludes[0] : $this->excludes;

        if ($includes && $excludes) {
            $body['includes'] = $includes;
            $body['excludes'] = $excludes;
        } elseif ($includes) {
            $body = $includes;
        } elseif ($excludes) {
            $body['excludes'] = $excludes;
        } else {
            $body = new stdClass();
        }

        return $body;
    }
}
