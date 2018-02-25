<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use stdClass;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-match-all-query.html
 * @see MatchAllMatcherTest
 *
 * @options 'boost' => 1.0,
 *          '_name' => '?',
 */
class MatchAllMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        if (!empty($this->options)) {
            $body = $this->options;
        } else {
            $body = new stdClass();
        }

        return [
            'match_all' => $body,
        ];
    }
}
