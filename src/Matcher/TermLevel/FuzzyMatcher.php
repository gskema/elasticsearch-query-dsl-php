<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MultiTermMatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-fuzzy-query.html
 * @see FuzzyMatcherTest
 *
 * @options 'boost' => 2.0,
 *          'fuzziness' => 'AUTO', 5,
 *          'prefix_length' => 0,
 *          'max_expansions' => 50,
 *          '_name' => '?',
 */
class FuzzyMatcher implements MultiTermMatcherInterface
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
            'fuzzy' => [
                $this->field => $body,
            ],
        ];
    }
}
