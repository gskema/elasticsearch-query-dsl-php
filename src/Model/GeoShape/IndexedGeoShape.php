<?php

namespace Gskema\ElasticSearchQueryDSL\Model\GeoShape;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-geo-shape-query.html#_pre_indexed_shape
 * @see IndexedGeoShapeTest
 */
class IndexedGeoShape implements GeoShapeInterface
{
    public function __construct(
        protected string $index,
        protected string $type,
        protected string $id,
        protected string $path,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'index' => $this->index,
            'type' => $this->type,
            'id' => $this->id,
            'path' => $this->path,
        ];
    }
}
