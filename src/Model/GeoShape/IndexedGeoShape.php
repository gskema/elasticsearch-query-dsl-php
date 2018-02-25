<?php

namespace Gskema\ElasticSearchQueryDSL\Model\GeoShape;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-geo-shape-query.html#_pre_indexed_shape
 * @see IndexedGeoShapeTest
 */
class IndexedGeoShape implements GeoShapeInterface
{
    /** @var string */
    protected $index;

    /** @var string */
    protected $type;

    /** @var string */
    protected $id;

    /** @var string */
    protected $path;

    public function __construct(string $index, string $type, string $id, string $path)
    {
        $this->index = $index;
        $this->type = $type;
        $this->id = $id;
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'index' => $this->index,
            'type' => $this->type,
            'id' => $this->id,
            'path' => $this->path,
        ];
    }
}
