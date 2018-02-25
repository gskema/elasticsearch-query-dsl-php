<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-common-terms-query.html
 * @see CommonTermsMatcherTest
 *
 * @options 'minimum_should_match' => ?, ['low_freq' => 2, 'high_freq' => 3],
 *          'low_freq_operator' => 'and', 'or',
 *          'high_freq_operator' => 'and', 'or',
 *          'boost' => 2.0,
 *          'analyzer' => 'standard',
 *          'disable_coord' => true,
 *          '_name' => '?',
 */
class CommonTermsMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string */
    protected $query;

    /** @var float */
    protected $cutoffFrequency;

    public function __construct(string $field, string $query, float $cutoffFrequency, array $options = [])
    {
        $this->field = $field;
        $this->query = $query;
        $this->cutoffFrequency = $cutoffFrequency;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [
            'query' => $this->query,
            'cutoff_frequency' => $this->cutoffFrequency,
        ];
        $body += $this->options;

        return [
            'common' => [
                $this->field => $body,
            ]
        ];
    }
}
