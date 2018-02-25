<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MultiTermMatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-wildcard-query.html
 * @see WildcardMatcherTest
 *
 * @options 'boost' => 1.0,
 *          '_name' => '?',
 */
class WildcardMatcher implements MultiTermMatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string */
    protected $value;

    public function __construct(string $field, string $value, array $options = [])
    {
        $this->field = $field;
        $this->value = $value;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        if (!empty($this->options)) {
            $body['value'] = $this->value;
            $body += $this->options;
        } else {
            $body = $this->value;
        }

        return [
            'wildcard' => [
                $this->field => $body,
            ],
        ];
    }
}
