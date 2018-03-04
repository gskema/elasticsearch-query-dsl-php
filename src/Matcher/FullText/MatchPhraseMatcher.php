<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-match-query-phrase.html
 * @see MatchPhraseMatcherTest
 *
 * @options 'slop' => 2,
 *          'analyzer' => 'standard',
 *          '_name' => '?',
 */
class MatchPhraseMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string */
    protected $query;

    public function __construct(string $field, string $query, array $options = [])
    {
        $this->field = $field;
        $this->query = $query;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body = [];
        $body['query'] = $this->query;
        $body += $this->options;

        return [
            'match_phrase' => [
                $this->field => $body,
            ],
        ];
    }
}
