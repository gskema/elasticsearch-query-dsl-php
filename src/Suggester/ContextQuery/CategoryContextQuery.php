<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester\ContextQuery;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/suggester-context.html#suggester-context-category
 * @see CategoryContextQueryTest
 */
class CategoryContextQuery implements ContextQueryInterface
{
    /** @var array[] */
    protected $clauses = [];

    public function addCategory(string $category, float $boost = null, bool $prefix = null): CategoryContextQuery
    {
        $clause['context'] = $category;
        if (null !== $boost) {
            $clause['boost'] = $boost;
        }
        if (null !== $prefix) {
            $clause['prefix'] = $prefix;
        }

        $this->clauses[] = $clause;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $hasParameters = false;
        foreach ($this->clauses as $clause) {
            if (count($clause) > 1) {
                $hasParameters = true;
                break;
            }
        }

        if ($hasParameters) {
            $body = $this->clauses;
        } else {
            $body = array_column($this->clauses, 'context');
        }

        return $body;
    }
}
