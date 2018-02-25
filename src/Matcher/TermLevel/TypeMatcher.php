<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\TermLevel;

use Gskema\ElasticSearchQueryDSL\HasOptionsTrait;
use Gskema\ElasticSearchQueryDSL\Matcher\MatcherInterface;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-type-query.html
 * @see TypeMatcherTest
 *
 * @options '_name' => '?',
 */
class TypeMatcher implements MatcherInterface
{
    use HasOptionsTrait;

    /** @var string */
    protected $docType;

    public function __construct(string $docType)
    {
        $this->docType = $docType;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $body['value'] = $this->docType;
        $body += $this->options;

        return [
            'type' => $body,
        ];
    }
}
