<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see LookupTermsMatcher
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-terms-query.html
 * @see TermsMatcherTest
 *
 * @options '_name' => '?',
 */
class TermsMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    /** @var string[]|float[]|int[]|bool[]|null[]|null */
    protected $values;

    public function __construct(string $field, array $values)
    {
        $this->field = $field;
        $this->values = $values;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body[$this->field] = $this->values;
        $body += $this->options;

        return [
            'terms' => $body,
        ];
    }
}
