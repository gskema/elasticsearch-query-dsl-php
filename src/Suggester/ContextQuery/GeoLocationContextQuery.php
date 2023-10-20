<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester\ContextQuery;

use Gskema\ElasticSearchQueryDSL\Model\GeoPointInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/suggester-context.html#_category_query
 * @see GeoLocationContextQueryTest
 */
class GeoLocationContextQuery implements ContextQueryInterface
{
    /** @var mixed[][] */
    protected array $clauses = [];

    /**
     * @param mixed[] $neighbours
     */
    public function addGeoPoint(
        GeoPointInterface $point,
        ?int $precision = null,
        ?float $boost = null,
        array $neighbours = [],
    ): static {
        $clause = [];
        $clause['context'] = $point->jsonSerialize();
        if (null !== $precision) {
            $clause['precision'] = $precision;
        }
        if (null !== $boost) {
            $clause['boost'] = $boost;
        }
        if (!empty($neighbours)) {
            $clause['neighbours'] = $neighbours;
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
