<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-exists-query.html
 * @see ExistsMatcherTest
 *
 * @options '_name' => '?',
 */
class ExistsMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $field;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body['field'] = $this->field;
        $body += $this->options;

        return [
            'exists' => $body,
        ];
    }
}
