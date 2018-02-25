<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Geo;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Model\GeoPointInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-geo-distance-range-query.html
 * @see GeoDistanceRangeMatcherTest
 *
 * @options 'distance_type' => 'arc', 'plane',
 *          'optimize_bbox' => 'memory', 'indexed',
 *          'ignore_malformed' => true,
 *          'ignore_unmapped' => true,
 *          'validation_method' => 'IGNORE_MALFORMED', 'COERCE', 'STRICT',
 *          'include_upper' => ?,
 *          'include_lower' => ?,
 *          '_name' => '?',
 */
class GeoDistanceRangeMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var GeoPointInterface */
    protected $origin;

    /**
     * 'lt' => '1km',
     * 'lte' => '1m',
     * 'gt' => '1cm',
     * 'gte' => '1mi',
     * 'from' => '1yd',
     * 'to' => '1in',
     *
     * @var array
     */
    protected $range;

    public function __construct(string $field, GeoPointInterface $origin, array $range, array $options = [])
    {
        $this->field = $field;
        $this->origin = $origin;
        $this->range = $range;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body[$this->field] = $this->origin->jsonSerialize();
        $body += $this->range;
        $body += $this->options;

        return [
            'geo_distance_range' => $body,
        ];
    }
}
