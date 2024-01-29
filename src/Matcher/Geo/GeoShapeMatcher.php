<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Geo;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Model\GeoShape\GeoShapeInterface;
use Gskema\ElasticsearchQueryDSL\Model\GeoShape\IndexedGeoShape;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-geo-shape-query.html
 * @see GeoShapeMatcherTest
 */
#[Options([
    'ignore_unmapped' => true,
    '_name' => '?',
])]
class GeoShapeMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        protected GeoShapeInterface $geoShape,
        protected ?string $relation = null, // 'INTERSECTS', DISJOINT, 'WITHIN', 'CONTAINS'
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->geoShape = clone $this->geoShape;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $shapeKey = $this->geoShape instanceof IndexedGeoShape ? 'indexed_shape' : 'shape';

        $body = [];
        $body[$this->field][$shapeKey] = $this->geoShape->jsonSerialize();
        if (null !== $this->relation) {
            $body[$this->field]['relation'] = $this->relation;
        }
        $body += $this->options;

        return [
            'geo_shape' => $body,
        ];
    }
}
