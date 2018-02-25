<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Geo;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Model\GeoPointInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-geo-bounding-box-query.html
 * @see GeoBoundingBoxMatcherTest
 *
 * @options 'validation_method' => 'IGNORE_MALFORMED', 'COERCE', 'STRICT'
 *          'type' => 'indexed', 'memory',
 *          'ignore_unmapped' => true,
 *          '_name' => '?',
 */
class GeoBoundingBoxMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var GeoPointInterface */
    protected $topLeft;

    /** @var GeoPointInterface */
    protected $topRight;

    /** @var GeoPointInterface */
    protected $bottomLeft;

    /** @var GeoPointInterface */
    protected $bottomRight;

    protected function __construct(
        string $field,
        GeoPointInterface $topLeft = null,
        GeoPointInterface $topRight = null,
        GeoPointInterface $bottomLeft = null,
        GeoPointInterface $bottomRight = null,
        array $options = []
    ) {
        $this->field = $field;
        $this->topLeft = $topLeft;
        $this->topRight = $topRight;
        $this->bottomLeft = $bottomLeft;
        $this->bottomRight = $bottomRight;
        $this->options = $options;
    }

    public static function fromTopLeft(
        string $field,
        GeoPointInterface $topLeft,
        GeoPointInterface $bottomRight,
        array $options = []
    ): GeoBoundingBoxMatcher {
        return new static($field, $topLeft, null, null, $bottomRight, $options);
    }

    public static function fromTopRight(
        string $field,
        GeoPointInterface $topRight,
        GeoPointInterface $bottomLeft,
        array $options = []
    ): GeoBoundingBoxMatcher {
        return new static($field, null, $topRight, $bottomLeft, null, $options);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $rawBox = [];
        if (null !== $this->topLeft) {
            $rawBox['top_left'] = $this->topLeft->jsonSerialize();
        }
        if (null !== $this->topRight) {
            $rawBox['top_right'] = $this->topRight->jsonSerialize();
        }
        if (null !== $this->bottomLeft) {
            $rawBox['bottom_left'] = $this->bottomLeft->jsonSerialize();
        }
        if (null !== $this->bottomRight) {
            $rawBox['bottom_right'] = $this->bottomRight->jsonSerialize();
        }

        $body[$this->field] = $rawBox;
        $body += $this->options;

        return [
            'geo_bounding_box' => $body,
        ];
    }
}
