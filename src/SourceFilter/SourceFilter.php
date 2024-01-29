<?php

namespace Gskema\ElasticsearchQueryDSL\SourceFilter;

use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/search-request-source-filtering.html
 * @see SourceFilterTest
 */
class SourceFilter implements SourceFilterInterface
{
    public function __construct(
        /** @var string[] */
        protected array $includes = [],
        /** @var string[] */
        protected array $excludes = [],
    ) {
    }

    /**
     * @return string[]
     */
    public function getIncludes(): array
    {
        return $this->includes;
    }

    /**
     * @param string[] $includes
     */
    public function setIncludes(array $includes): static
    {
        $this->includes = $includes;
        return $this;
    }

    public function addInclude(string $includedField): static
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
     */
    public function setExcludes(array $excludes): static
    {
        $this->excludes = $excludes;
        return $this;
    }

    public function addExclude(string $excludedField): static
    {
        $this->excludes[] = $excludedField;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $includes = 1 === count($this->includes) ? $this->includes[0] : $this->includes;
        $excludes = 1 === count($this->excludes) ? $this->excludes[0] : $this->excludes;

        $body = [];
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
