<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Geo;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;
use Gskema\ElasticSearchQueryDSL\Model\GeoPointInterface;
use InvalidArgumentException;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-geo-polygon-query.html
 * @see GeoPolygonMatcherTest
 *
 * @options 'ignore_malformed' => true,
 *          'ignore_unmapped' => true,
 *          'validation_method' => 'IGNORE_MALFORMED', 'COERCE', 'STRICT',
 *          '_name' => '?',
 */
class GeoPolygonMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var GeoPointInterface[] */
    protected $points;

    /**
     * @param string                 $field
     * @param GeoPointInterface[] $points
     * @param array                  $options
     */
    public function __construct(string $field, array $points, array $options = [])
    {
        $pointCount = count($points);
        if ($pointCount < 3) {
            throw new InvalidArgumentException('Expected at least 3 geo polygon points, got '.$pointCount);
        }
        $this->field = $field;
        $this->points = $points;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $rawPoints = array_map(function (GeoPointInterface $point) {
            return $point->jsonSerialize();
        }, $this->points);

        $body[$this->field]['points'] = $rawPoints;
        $body += $this->options;

        return [
            'geo_polygon' => $body,
        ];
    }
}
