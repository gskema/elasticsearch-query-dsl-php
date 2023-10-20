<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Geo;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Model\GeoPointInterface;
use Gskema\ElasticSearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-geo-bounding-box-query.html
 * @see GeoBoundingBoxMatcherTest
 */
#[Options([
    'validation_method' => 'IGNORE_MALFORMED', // 'COERCE', 'STRICT'
    'type' => 'indexed', // 'memory',
    'ignore_unmapped' => true,
    '_name' => '?',
])]
class GeoBoundingBoxMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    protected function __construct(
        protected string $field,
        protected ?GeoPointInterface $topLeft = null,
        protected ?GeoPointInterface $topRight = null,
        protected ?GeoPointInterface $bottomLeft = null,
        protected ?GeoPointInterface $bottomRight = null,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->topLeft = $this->topLeft ? clone $this->topLeft : null;
        $this->topRight = $this->topRight ? clone $this->topRight : null;
        $this->bottomLeft = $this->bottomLeft ? clone $this->bottomLeft : null;
        $this->bottomRight = $this->bottomRight ? clone $this->bottomRight : null;
    }

    /**
     * @param array<string, mixed> $options
     */
    public static function fromTopLeft(
        string $field,
        GeoPointInterface $topLeft,
        GeoPointInterface $bottomRight,
        array $options = [],
    ): static {
        return new static($field, $topLeft, null, null, $bottomRight, $options);
    }

    /**
     * @param array<string, mixed> $options
     */
    public static function fromTopRight(
        string $field,
        GeoPointInterface $topRight,
        GeoPointInterface $bottomLeft,
        array $options = [],
    ): static {
        return new static($field, null, $topRight, $bottomLeft, null, $options);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
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

        $body = [];
        $body[$this->field] = $rawBox;
        $body += $this->options;

        return [
            'geo_bounding_box' => $body,
        ];
    }
}
