<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Geo;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Model\GeoPointInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-geo-distance-query.html
 * @see GeoDistanceMatcherTest
 *
 * @options 'distance_type' => 'arc', 'plane',
 *          'optimize_bbox' => 'memory', 'indexed',
 *          'ignore_malformed' => true,
 *          'ignore_unmapped' => true,
 *          'validation_method' => 'IGNORE_MALFORMED', 'COERCE', 'STRICT',
 *          '_name' => '?',
 */
class GeoDistanceMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var GeoPointInterface */
    protected $origin;

    /** @var string */
    protected $distance;

    public function __construct(string $field, GeoPointInterface $origin, string $distance, array $options = [])
    {
        $this->field = $field;
        $this->origin = $origin;
        $this->distance = $distance;
        $this->options = $options;
    }

    public function __clone()
    {
        $this->origin = clone $this->origin;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [
            $this->field => $this->origin->jsonSerialize(),
            'distance' => $this->distance,
        ];
        $body += $this->options;

        return [
            'geo_distance' => $body,
        ];
    }
}
