<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester\ContextQuery;

use Gskema\ElasticSearchQueryDSL\Model\GeoPointInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/suggester-context.html#_category_query
 * @see GeoLocationContextQueryTest
 */
class GeoLocationContextQuery implements ContextQueryInterface
{
    /** @var array[] */
    protected $clauses = [];

    public function addGeoPoint(
        GeoPointInterface $point,
        int $precision = null,
        float $boost = null,
        array $neighbours = []
    ): GeoLocationContextQuery {
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
