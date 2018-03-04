<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MultiTermMatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-regexp-query.html
 * @see RegexMatcherTest
 *
 * @options 'flags' => 'ALL|ANYSTRING|COMPLEMENT|EMPTY|INTERSECTION|INTERVAL|NONE',
 *          'max_determinized_states' => 2000,
 *          '_name' => '?',
 */
class RegexMatcher implements MultiTermMatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string */
    protected $regex;

    public function __construct(string $field, string $regex, array $options = [])
    {
        $this->field = $field;
        $this->regex = $regex;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        if (!empty($this->options)) {
            $body = [];
            $body['value'] = $this->regex;
            $body += $this->options;
        } else {
            $body = $this->regex;
        }

        return [
            'regexp' => [
                $this->field => $body,
            ],
        ];
    }
}
