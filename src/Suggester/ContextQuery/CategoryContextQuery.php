<?php

namespace Gskema\ElasticsearchQueryDSL\Suggester\ContextQuery;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/suggester-context.html#suggester-context-category
 * @see CategoryContextQueryTest
 */
class CategoryContextQuery implements ContextQueryInterface
{
    /** @var mixed[][] */
    protected array $clauses = [];

    public function addCategory(string $category, ?float $boost = null, ?bool $prefix = null): static
    {
        $clause = [];
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
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
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
