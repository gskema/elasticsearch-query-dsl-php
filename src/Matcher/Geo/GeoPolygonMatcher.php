<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Geo;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Model\GeoPointInterface;
use Gskema\ElasticsearchQueryDSL\Options;
use InvalidArgumentException;

use function Gskema\ElasticsearchQueryDSL\array_clone;
use function Gskema\ElasticsearchQueryDSL\obj_array_json_serialize;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-geo-polygon-query.html
 * @see GeoPolygonMatcherTest
 */
#[Options([
    'ignore_unmapped' => true,
    'validation_method' => 'IGNORE_MALFORMED', // 'COERCE', 'STRICT',
    '_name' => '?',
])]
class GeoPolygonMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        /** @var GeoPointInterface[] */
        protected array $points,
        array $options = [],
    ) {
        $pointCount = count($points);
        if ($pointCount < 3) {
            throw new InvalidArgumentException('Expected at least 3 geo polygon points, got ' . $pointCount);
        }
        $this->options = $options;
    }

    public function __clone()
    {
        $this->points = array_clone($this->points);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        $rawPoints = obj_array_json_serialize($this->points);

        $body = [];
        $body[$this->field]['points'] = $rawPoints;
        $body += $this->options;

        return [
            'geo_polygon' => $body,
        ];
    }
}
