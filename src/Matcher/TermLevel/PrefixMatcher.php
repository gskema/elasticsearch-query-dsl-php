<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MultiTermMatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-prefix-query.html
 * @see PrefixMatcherTest
 *
 * @options 'boost' => 1.0,
 *          '_name' => '?',
 */
class PrefixMatcher implements MultiTermMatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string */
    protected $prefix;

    public function __construct(string $field, string $prefix, array $options = [])
    {
        $this->field = $field;
        $this->prefix = $prefix;
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        if (!empty($this->options)) {
            $body['value'] = $this->prefix;
            $body += $this->options;
        } else {
            $body = $this->prefix;
        }

        return [
            'prefix' => [
                $this->field => $body,
            ],
        ];
    }
}
