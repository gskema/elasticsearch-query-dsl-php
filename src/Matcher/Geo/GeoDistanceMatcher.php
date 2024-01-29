<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Geo;

use Gskema\ElasticsearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticsearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticsearchQueryDSL\Model\GeoPointInterface;
use Gskema\ElasticsearchQueryDSL\Options;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/6.8/query-dsl-geo-distance-query.html
 * @see GeoDistanceMatcherTest
 */
#[Options([
    'distance_type' => 'arc', // 'plane',
    'ignore_unmapped' => true,
    'validation_method' => 'IGNORE_MALFORMED', // 'COERCE', 'STRICT',
    '_name' => '?',
])]
class GeoDistanceMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        protected string $field,
        protected GeoPointInterface $origin,
        protected string $distance,
        array $options = [],
    ) {
        $this->options = $options;
    }

    public function __clone()
    {
        $this->origin = clone $this->origin;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
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
