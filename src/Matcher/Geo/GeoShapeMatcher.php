<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Geo;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Model\GeoShape\GeoShapeInterface;
use Gskema\ElasticSearchQueryDSL\Model\GeoShape\IndexedGeoShape;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-geo-shape-query.html
 * @see GeoShapeMatcherTest
 *
 * @options 'ignore_unmapped' => true,
 *          '_name' => '?',
 */
class GeoShapeMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var GeoShapeInterface */
    protected $geoShape;

    /**
     * 'INTERSECTS', DISJOINT, 'WITHIN', 'CONTAINS'
     *
     * @var string|null
     */
    protected $relation;

    public function __construct(
        string $field,
        GeoShapeInterface $geoShape,
        string $relation = null,
        array $options = []
    ) {
        $this->field = $field;
        $this->geoShape = $geoShape;
        $this->relation = $relation;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $shapeKey = $this->geoShape instanceof IndexedGeoShape ? 'indexed_shape' : 'shape';

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
