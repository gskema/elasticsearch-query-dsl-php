<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-term-query.html
 * @see TermMatcherTest
 *
 * @options 'boost' => 1.0,
 *          '_name' => '?',
 */
class TermMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string|float|int|bool|null */
    protected $value;

    /**
     * @param string                     $field
     * @param string|float|int|bool|null $value
     * @param array                      $options
     */
    public function __construct(string $field, $value, array $options = [])
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
            'term' => [
                $this->field => $body,
            ],
        ];
    }
}
